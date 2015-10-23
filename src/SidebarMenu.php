<?php

/*
 * Hipanel Module Dns
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns;

use Yii;

class SidebarMenu extends \hipanel\base\Menu implements \yii\base\BootstrapInterface
{
    protected $_addTo = 'sidebar';

    protected $_where = [
        'after'  => ['clients', 'dashboard', 'header', 'servers', 'hosting'],
        'before' => ['tickets', 'domains'],
    ];

    public function items()
    {
        return [
            'finance' => [
                'label' => Yii::t('app', 'DNS'),
                'url'   => ['/dns/domains/index'],
                'icon'  => 'fa-globe',
                'items' => [
                    'payments' => [
                        'label' => Yii::t('app', 'Domains'),
                        'url'   => ['/dns/domain/index'],
                    ],
                ],
            ],
        ];
    }
}
