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

use hipanel\actions\IndexAction;
use hipanel\filters\EasyAccessControl;
use hipanel\modules\dns\models\Record;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class ZoneController extends \hipanel\base\CrudController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => EasyAccessControl::class,
                'actions' => [
                    '*' => 'dns.read',
                ],
            ],
        ]);
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'filterStorageMap' => [
                    'domain' => 'dns.zone.domain',
                    'ips' => 'hosting.ip.ip_in',
                    'dns_on' => 'domain.domain.dns_on',
                    'client_id' => 'client.client.id',
                    'seller_id' => 'client.client.seller_id',
                    'server' => 'server.server.name',
                    'account' => 'hosting.account.login',
                ],
            ],
        ]);
    }

    public function actionView($id)
    {
        if (($model = $this->newModel()->find()->joinWith('records')->where(['id' => $id])->one()) === null) {
            throw new NotFoundHttpException('DNS zone does not exist');
        }
        $recordsDataProvider = new ArrayDataProvider([
            'allModels' => $model->records,
            'pagination' => false,
            'modelClass' => Record::class,
        ]);

        return $this->render('view', [
            'model' => $model,
            'recordsDataProvider' => $recordsDataProvider,
        ]);
    }
}
