<?php

namespace hipanel\modules\dns\menus;

use hiqdev\menumanager\Menu;
use Yii;

class DnsActionsMenu extends Menu
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
