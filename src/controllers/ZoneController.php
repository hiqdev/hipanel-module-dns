<?php

namespace hipanel\modules\dns\controllers;

use Yii;
use yii\data\ArrayDataProvider;

class ZoneController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'hipanel\actions\IndexAction',
            ],
        ];
    }

    public function actionView($id) {
        $model = $this->newModel()->find()->joinWith('records')->where(['id' => $id])->one();
        $recordsDataProvider = new ArrayDataProvider([
            'allModels' => $model->records
        ]);

        return $this->render('view', [
            'model' => $model,
            'recordsDataProvider' => $recordsDataProvider
        ]);
    }
}
