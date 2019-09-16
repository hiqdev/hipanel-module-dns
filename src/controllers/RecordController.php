<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\controllers;

use hipanel\actions\RedirectAction;
use hipanel\actions\ValidateFormAction;
use hipanel\filters\EasyAccessControl;
use hipanel\helpers\ArrayHelper;
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use hiqdev\hiart\Collection;
use hiqdev\hiart\Exception;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class RecordController extends \hipanel\base\CrudController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => EasyAccessControl::class,
                'actions' => [
                    'create' => 'dns.create',
                    'update' => 'dns.update',
                    'delete' => 'dns.delete',
                    '*' => 'dns.read',
                ],
            ],
        ]);
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => RedirectAction::class,
                'url' => '@dns/zone',
            ],
            'validate-form' => [
                'class' => ValidateFormAction::class,
            ],
        ]);
    }

    /**
     * Created the DNS record.
     *
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'create']),
        ]))->load();

        if ($collection->count()) {
            try {
                $collection->save();
                Yii::$app->session->addFlash('success', Yii::t('hipanel:dns', '{0, plural, one{DNS record} other{# DNS records}} created successfully', $collection->count()));
            } catch (Exception $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
            }
            return $this->renderZoneView($collection->first->hdomain_id);
        } elseif ($id = $collection->first->hdomain_id) {
            return $this->redirect(['@dns/zone/view', 'id' => $id]);
        }

        throw new BadRequestHttpException('Bad request');
    }

    /**
     * Updates the DNS record.
     *
     * @param integer $id
     * @param integer $hdomain_id
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @return string
     */
    public function actionUpdate($id = null, $hdomain_id = null)
    {
        if ($id && $hdomain_id && $model = $this->newModel()->findOne(compact('id', 'hdomain_id'))) {
            $model->scenario = 'update';

            return $this->renderAjax('update', ['model' => $model]);
        }

        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'update']),
        ]))->load();

        if ($collection->first->id && $collection->save()) {
            Yii::$app->session->addFlash('success', Yii::t('hipanel:dns', '{0, plural, one{DNS record} other{# DNS records}} updated successfully', $collection->count()));

            return $this->renderZoneView($collection->first->hdomain_id);
        }
        throw new BadRequestHttpException('Bad request');
    }

    /**
     * Deletes the record.
     *
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @return string|\yii\web\Response
     */
    public function actionDelete()
    {
        $collection = (new Collection([
            'model' => $this->newModel(['scenario' => 'delete']),
        ]))->load();

        if ($collection->validate() && $collection->save()) {
            Yii::$app->session->addFlash('success', Yii::t('hipanel:dns', '{0, plural, one{DNS record} other{# DNS records}} deleted successfully', $collection->count()));

            return $this->renderZoneView($collection->first->hdomain_id);
        } elseif ($id = $collection->first->hdomain_id) {
            return $this->redirect(['@dns/zone/view', 'id' => $id]);
        }

        throw new BadRequestHttpException('Bad request');
    }

    public function actionExportHosts(array $type_in = ['a', 'aaaa', 'cname', 'txt', 'soa', 'ns', 'mx', 'srv'])
    {
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
     * Renders zone view. Duplicates ZoneController/actionView.
     *
     * @param $id
     * @throws NotFoundHttpException
     * @return string
     */
    public function renderZoneView($id)
    {
        if (($model = (new Zone())->find()->joinWith('records')->where(['id' => $id])->one()) === null) {
            throw new NotFoundHttpException('DNS zone does not exist');
        }
        $recordsDataProvider = new ArrayDataProvider(['allModels' => $model->records, 'pagination' => false]);

        return $this->render('/zone/view', [
            'model' => $model,
            'recordsDataProvider' => $recordsDataProvider,
        ]);
    }
}
