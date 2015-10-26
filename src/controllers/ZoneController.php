<?php

namespace hipanel\modules\dns\controllers;

use Yii;

class ZoneController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'hipanel\actions\IndexAction',
            ],
            'view' => [
                'class' => 'hipanel\actions\ViewAction',
            ],
        ];
    }
}
