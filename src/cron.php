<?php

declare(strict_types=1);
/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'load.php';

use FOSSBilling\Environment;
use FOSSBilling\RabbitMQService;
use Symfony\Component\Filesystem\Path;

$di = include Path::join(PATH_ROOT, 'di.php');

$di['translate']();

try {
    $interval = $argv[1] ?? null;
    $service = $di['mod_service']('cron');

    $serviceId = 'cron';

    if (Environment::isCLI()) {
        $di['logger']->setChannel($serviceId)->info("Welcome to FOSSBilling.");
        $di['logger']->setChannel($serviceId)->info("Last executed: {$service->getLastExecutionTime()}.");
    }

    $service->runCrons($interval);
} catch (Exception $exception) {
    throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
} finally {
    if (Environment::isCLI()) {
        $di['logger']->setChannel($serviceId)->info("Successfully ran the cron jobs.");
    }
}
