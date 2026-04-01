param(
    [string]$SourceDumpPath = "db-full.sql",
    [string]$ContainerName = "facturatie-schema-temp-db",
    [string]$DatabaseName = "fossbilling",
    [string]$BaselineOutPath = "docker/db/init/baseline-schema.sql"
)

$ErrorActionPreference = "Stop"
$previousNativeErrorPreference = $PSNativeCommandUseErrorActionPreference
$PSNativeCommandUseErrorActionPreference = $false

function Resolve-WorkspacePath([string]$PathValue) {
    if ([System.IO.Path]::IsPathRooted($PathValue)) {
        return $PathValue
    }

    return (Join-Path (Get-Location).Path $PathValue)
}

$sourceDump = Resolve-WorkspacePath $SourceDumpPath
$baselineOut = Resolve-WorkspacePath $BaselineOutPath

if (-not (Test-Path $sourceDump)) {
    throw "Source dump not found: $sourceDump"
}

$sourceUtf8 = [System.IO.Path]::ChangeExtension($sourceDump, ".utf8.sql")

try {
    Write-Host "Converting source dump to UTF-8..."
    $bytes = [System.IO.File]::ReadAllBytes($sourceDump)

    if ($bytes.Length -ge 2 -and $bytes[0] -eq 0xFF -and $bytes[1] -eq 0xFE) {
        $text = [System.Text.Encoding]::Unicode.GetString($bytes, 2, $bytes.Length - 2)
    } else {
        $text = [System.Text.Encoding]::UTF8.GetString($bytes)
    }

    $utf8NoBom = New-Object System.Text.UTF8Encoding($false)
    [System.IO.File]::WriteAllText($sourceUtf8, $text, $utf8NoBom)

    Write-Host "Starting temporary MariaDB container..."
    try {
        docker rm -f $ContainerName *> $null
    } catch {
        # Ignore cleanup errors if the container does not exist.
    }
    docker run --name $ContainerName -e MARIADB_ALLOW_EMPTY_ROOT_PASSWORD=1 -e MARIADB_DATABASE=$DatabaseName -d mariadb:10.11 | Out-Null

    Write-Host "Waiting for MariaDB readiness..."
    $ready = $false
    for ($i = 0; $i -lt 60; $i++) {
        docker exec $ContainerName sh -c "mariadb --protocol=socket -u root $DatabaseName -e 'SELECT 1;' >/dev/null 2>&1" *> $null
        if ($LASTEXITCODE -eq 0) {
            $ready = $true
            break
        }
        Start-Sleep -Seconds 1
    }

    if (-not $ready) {
        throw "MariaDB container did not become ready in time."
    }

    Write-Host "Importing current dump into temporary DB..."
    Get-Content -Path $sourceUtf8 -Raw | docker exec -i $ContainerName mariadb --protocol=socket -u root $DatabaseName
    if ($LASTEXITCODE -ne 0) {
        throw "Failed to import source dump into temporary MariaDB container."
    }

    Write-Host "Exporting schema-only baseline..."
    $schemaOutput = docker exec $ContainerName sh -c "mysqldump -u root --no-data --routines --triggers --events $DatabaseName"
    if ($LASTEXITCODE -ne 0) {
        throw "Failed to export schema from temporary MariaDB container."
    }
    [System.IO.File]::WriteAllText($baselineOut, ($schemaOutput -join [Environment]::NewLine), $utf8NoBom)

    Write-Host "Baseline schema generated at: $baselineOut"
    Write-Host "Review and commit docker/db/init/baseline-schema.sql."
} finally {
    $PSNativeCommandUseErrorActionPreference = $previousNativeErrorPreference
    Write-Host "Cleaning up temporary files/containers..."
    if (Test-Path $sourceUtf8) {
        Remove-Item -Path $sourceUtf8 -Force
    }
    try {
        docker rm -f $ContainerName *> $null
    } catch {
        # Ignore cleanup errors if the container does not exist.
    }
}
