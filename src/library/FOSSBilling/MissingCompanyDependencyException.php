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

namespace FOSSBilling;

class MissingCompanyDependencyException extends \RuntimeException
{
    public function __construct(private readonly string $companyId)
    {
        parent::__construct(sprintf('Missing company dependency for company_id=%s', $companyId));
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }
}
