<?php

/**
 * Copyright 2022-2025 FOSSBilling
 * Copyright 2011-2021 BoxBilling, Inc.
 * SPDX-License-Identifier: Apache-2.0.
 *
 * @copyright FOSSBilling (https://www.fossbilling.org)
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 */

namespace Box\Mod\Company\Controller;

class Admin implements \FOSSBilling\InjectionAwareInterface
{
    protected ?\Pimple\Container $di = null;

    public function setDi(\Pimple\Container $di): void
    {
        $this->di = $di;
    }

    public function getDi(): ?\Pimple\Container
    {
        return $this->di;
    }

    public function fetchNavigation()
    {
        return [
            'group' => [
                'index' => 205,
                'location' => 'company',
                'label' => __trans('Companies'),
                'uri' => $this->di['url']->adminLink('company'),
                'class' => 'contacts',
            ],
            'subpages' => [
                [
                    'location' => 'company',
                    'label' => __trans('Overview'),
                    'uri' => $this->di['url']->adminLink('company'),
                    'index' => 100,
                    'class' => '',
                ],
            ],
        ];
    }

    public function register(\Box_App &$app)
    {
        $app->get('/company', 'get_index', [], static::class);
        $app->get('/company/', 'get_index', [], static::class);
        $app->get('/company/manage/:id', 'get_manage', ['id' => '.+'], static::class);
    }

    public function get_index(\Box_App $app)
    {
        $this->di['is_admin_logged'];

        return $app->render('mod_company_index');
    }

    public function get_manage(\Box_App $app, string $id)
    {
        $this->di['is_admin_logged'];
        $company = $this->di['api_admin']->company_get(['id' => $id]);

        return $app->render('mod_company_manage', ['company' => $company]);
    }
}
