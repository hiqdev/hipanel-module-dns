<?php

namespace hipanel\modules\dns\menus;

use Yii;

class DomainSidebarSubMenu extends \hiqdev\yii2\menus\Menu
{
    public function items()
    {
        return [
            'domains' => [
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
