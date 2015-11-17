<?php

namespace hipanel\modules\dns\controllers;

use hipanel\helpers\ArrayHelper;
use hipanel\modules\dns\models\Record;
use hiqdev\hiart\Collection;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class RecordController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'hipanel\actions\RedirectAction',
                'url' => '@dns/zone',
            ],
            'validate-form' => [
                'class' => 'hipanel\actions\ValidateFormAction',
            ],
        ];
    }

    /**
     * Created the DNS record
     *
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'create'])
        ]))->load();

        if ($collection->count() && $collection->save()) {
            Yii::$app->session->addFlash('success', Yii::t('app', '{0, plural, one{DNS record} other{# DNS records}} created successfully', $collection->count()));
            return $this->renderZoneView($collection->first->hdomain_id);
        } elseif ($id = $collection->first->hdomain_id) {
            return $this->redirect(['@dns/zone/view', 'id' => $id]);
        }

        throw new BadRequestHttpException('Bad request');
    }

    /**
     * Updates the DNS record
     *
     * @param integer $id
     * @param integer $hdomain_id
     * @return string
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id = null, $hdomain_id = null) {
        if ($id && $hdomain_id && $model = $this->newModel()->findOne(compact('id', 'hdomain_id'))) {
            $model->scenario = 'update';
            return $this->renderAjax('update', ['model' => $model]);
        }

        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'update'])
        ]))->load();

        if ($collection->first->id && $collection->save()) {
            Yii::$app->session->addFlash('success', Yii::t('app', '{0, plural, one{DNS record} other{# DNS records}} updated successfully', $collection->count()));
            return $this->renderZoneView($collection->first->hdomain_id);
        }
        throw new BadRequestHttpException('Bad request123');
    }

    /**
     * Deletes the record
     *
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionDelete()
    {
        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'delete'])
        ]))->load();

        if ($collection->validate() && $collection->save()) {
            Yii::$app->session->addFlash('success', Yii::t('app', '{0, plural, one{DNS record} other{# DNS records}} deleted successfully', $collection->count()));
            return $this->renderZoneView($collection->first->hdomain_id);
        } elseif ($id = $collection->first->hdomain_id) {
            return $this->redirect(['@dns/zone/view', 'id' => $id]);
        }

        throw new BadRequestHttpException('Bad request');
    }

    public function actionExportHosts(array $type_in = ['a', 'aaaa']) {
        $searchModel = $this->searchModel(['scenario' => 'export-hosts']);
        $data = [$searchModel->formName() => ArrayHelper::merge([
            'hdomain_id_in' => Yii::$app->request->post('selection'),
        ], Yii::$app->request->post($searchModel->formName(), []))];

        $dataProvider = $searchModel->search($data, ['pagination' => false]);

        if (empty($searchModel->hdomain_id_in)) {
            return $this->redirect('@dns/zone');
        }

        return $this->render('export-hosts', [
            'dataProvider' => $dataProvider,
            'model' => $searchModel,
        ]);
    }

    /**
     * Renders zone view. Duplicates ZoneController/actionView
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function renderZoneView($id) {
        if (($model = $this->newModel()->find()->joinWith('records')->where(['id' => $id])->one()) === null) {
            throw new NotFoundHttpException('DNS zone does not exists');
        }
        $recordsDataProvider = new ArrayDataProvider(['allModels' => $model->records]);

        return $this->render('/zone/view', [
            'model' => $model,
            'recordsDataProvider' => $recordsDataProvider
        ]);
    }
}
