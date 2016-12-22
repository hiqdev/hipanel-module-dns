<?php

namespace hipanel\modules\dns\menus;

use Yii;

class DnsActionsMenu extends \hiqdev\yii2\menus\Menu
{
    public $model;

    public function items()
    {
        return [
            [
                'label' => Yii::t('hipanel', 'View'),
                'icon' => 'fa-info',
                'url' => ['@dns/zone/view', 'id' => $this->model->id],
            ],
        ];
    }
}
