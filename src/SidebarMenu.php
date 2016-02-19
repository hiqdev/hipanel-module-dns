<?php

/*
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns;

use Yii;

class SidebarMenu extends \hipanel\base\Menu implements \yii\base\BootstrapInterface
{
    protected $_addTo = 'sidebar';

    protected $_where = [
        'before' => ['server', 'domains'],
    ];

    public function items()
    {
        return [
            'dns' => [
                'label' => Yii::t('hipanel/dns', 'DNS'),
                'url'   => ['/dns/zone/index'],
                'icon'  => 'fa-globe',
                'items' => [
                    'zones' => [
                        'label' => Yii::t('hipanel/dns', 'Domains'),
                        'url'   => ['/dns/zone/index'],
                    ],
                ],
            ],
        ];
    }
}
