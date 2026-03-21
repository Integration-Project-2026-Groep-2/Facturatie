<?php

/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace Box\Mod\Company\Api;

class Admin extends \Api_Abstract
{
    public function get_list($data)
    {
        $perPage = $data['per_page'] ?? $this->di['pager']->getDefaultPerPage();
        [$query, $params] = $this->getService()->getSearchQuery($data);
        $pager = $this->di['pager']->getPaginatedResultSet($query, $params, $perPage);

        foreach ($pager['list'] as $key => $item) {
            $pager['list'][$key] = $this->getService()->toApiArray($item);
        }

        return $pager;
    }

    public function get_pairs(): array
    {
        return $this->getService()->getPairs();
    }

    public function get($data): array
    {
        $required = [
            'id' => 'Company ID is missing',
        ];
        $this->di['validator']->checkRequiredParamsForArray($required, $data);

        return $this->getService()->toApiArray($this->getService()->get((string) $data['id']));
    }

    public function create($data): string
    {
        $required = [
            'name' => 'Company name is required',
        ];
        $this->di['validator']->checkRequiredParamsForArray($required, $data);

        return $this->getService()->create($data);
    }

    public function update($data): bool
    {
        $required = [
            'id' => 'Company ID is missing',
            'name' => 'Company name is required',
        ];
        $this->di['validator']->checkRequiredParamsForArray($required, $data);

        $company = $this->getService()->get((string) $data['id']);

        return $this->getService()->update($company, $data);
    }

    public function delete($data): bool
    {
        $required = [
            'id' => 'Company ID is missing',
        ];
        $this->di['validator']->checkRequiredParamsForArray($required, $data);

        $company = $this->getService()->get((string) $data['id']);

        return $this->getService()->delete($company);
    }
}
