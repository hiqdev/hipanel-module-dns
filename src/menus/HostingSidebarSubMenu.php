<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\menus;

use Yii;

class HostingSidebarSubMenu extends \hiqdev\yii2\menus\Menu
{
    public function items()
    {
        return [
            'hosting' => [
                'items' => [
                    'dns' => [
                        'label' => Yii::t('hipanel:dns', 'DNS'),
                        'url'   => ['/dns/zone/index'],
                        'visible' => Yii::$app->user->can('dns.read'),
                    ],
                ],
            ],
        ];
    }
}
