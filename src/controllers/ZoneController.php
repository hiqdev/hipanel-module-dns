<?php

namespace hipanel\modules\dns\controllers;

use hipanel\actions\IndexAction;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class ZoneController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
            ],
        ];
    }

    public function actionView($id)
    {
        if (($model = $this->newModel()->find()->joinWith('records')->where(['id' => $id])->one()) === null) {
            throw new NotFoundHttpException('DNS zone does not exists');
        }
        $recordsDataProvider = new ArrayDataProvider(['allModels' => $model->records]);

        return $this->render('view', [
            'model' => $model,
            'recordsDataProvider' => $recordsDataProvider
        ]);
    }
}
