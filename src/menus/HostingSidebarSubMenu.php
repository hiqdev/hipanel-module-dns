<?php

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
                    ],
                ],
            ],
        ];
    }
}
