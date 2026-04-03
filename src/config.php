<?php
return [
    'security' => [
        'mode' => 'strict',
        'force_https' => false,
        'session_lifespan' => 7200,
        'perform_session_fingerprinting' => false,
        'debug_fingerprint' => false,
    ],

    'debug_and_monitoring' => [
        'debug' => false,
        'log_stacktrace' => true,
        'stacktrace_length' => 25,
        'report_errors' => false,
    ],

    'info' => [
        'salt' => 'e31ce59441d7be930bfae38f79f802cd', //placeholder
        'instance_id' => 'XXXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXXX',
    ],

    'url' => getenv('APP_URL') ?: 'localhost:8080/',

    'admin_area_prefix' => '/admin',

    'update_branch' => 'release',

    'maintenance_mode' => [
        'enabled' => false,
        'allowed_urls'=> [],
        'allowed_ips'=> [],
    ],

    'disable_auto_cron' => true,

    'i18n' => [
        'locale' => 'en_US',
        'timezone' => 'UTC',
        'date_format' => 'medium',
        'time_format' => 'short',
        'datetime_pattern' => '',
    ],

    'path_data' => '/var/www/html/data',

    'db' => [
        'type' => 'mysql',
        'host' => getenv('DB_HOST'),
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
        'port' => getenv('DB_PORT'),
    ],

    'twig' => [
        'debug' => false,
        'auto_reload' => true,
        'cache' => '/var/www/html/data/cache',
    ],

    'api' => [
        'require_referrer_header' => false,
        'allowed_ips'=> [],
        'rate_span' => 3600,
        'rate_limit' => 1000,
        'throttle_delay' => 2,
        'rate_span_login' => 60,
        'rate_limit_login' => 20,
        'CSRFPrevention' => true,
        'rate_limit_whitelist'=> [],
    ],

    'log_stacktrace' => true,

    'stacktrace_length' => 25,
];