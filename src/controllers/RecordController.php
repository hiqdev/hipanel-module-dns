<?php

namespace hipanel\modules\dns\controllers;

use Yii;
use yii\data\ArrayDataProvider;

class RecordController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'hipanel\actions\IndexAction',
            ],
            'validate-form' => [
                'class' => 'hipanel\actions\ValidateFormAction',
            ],
        ];
    }
}
