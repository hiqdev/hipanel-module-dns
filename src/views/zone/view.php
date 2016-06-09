<?php

use hipanel\modules\dns\grid\RecordGridView;
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use hipanel\widgets\Pjax;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\web\View;

/*
 * @var $this View
 * @var $model Zone
 * @var $recordsDataProvider ArrayDataProvider
 */

$this->title                    = $model->domain;
$this->subtitle                 = Yii::t('hipanel/dns', 'DNS zone for domain {domain}', ['domain' => $model->domain]) . ' #' . $model->id;
$this->params['breadcrumbs'][]  = ['label' => Yii::t('hipanel/dns', 'DNS'), 'url' => ['@dns/zone/index']];
$this->params['breadcrumbs'][]  = $this->title;

Pjax::begin([
    'id' => 'dns_zone_view',
    'enablePushState' => false,
]);

$records = $recordsDataProvider->getModels();

$ns_servers = [];
foreach ($records as $record) {
    if ($record->type === 'ns' && $record->service_id) {
        $ns_servers[] = $record['value'];
    }
}
\hipanel\helpers\ArrayHelper::multisort($ns_servers, 0);
?>

    <?php if ($model->is_served === false && count($ns_servers)) : ?>
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <h4><i class="fa fa-warning-circle"></i>&nbsp;&nbsp;<?= Yii::t('hipanel/dns', 'Set NS servers for domain {domain}', ['domain' => $model->domain]) ?></h4>

            <p>
                <?= Yii::t('hipanel/dns', 'This DNS zone belongs to domain {domain_link}, but it is not configured properly. To make these DNS records work, please change NS servers of domain to {ns_servers}.', [
                    'domain_link' => Html::a($model->domain, ['@domain/view', 'id' => $model->id]),
                    'ns_servers' => Html::tag('code', implode(', ', $ns_servers)),
                ]) ?>
            </p>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            $exampleModel = new Record([
                'domain' => $model->domain,
                'hdomain_id' => $model->id,
                'ttl' => 7200,
                'scenario' => 'create',
            ]);

            echo $this->render('/record/_form', [
                'model' => $exampleModel,
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo RecordGridView::widget([
                'boxed' => false,
                'dataProvider' => $recordsDataProvider,
                'options' => [
                    'class' => '',
                ],
                'columns' => [
                    'fqdn',
                    [
                        'attribute' => 'type',
                        'options' => [
                            'style' => 'width: 3%;',
                        ],
                        'value' => function ($model) {
                            return strtoupper($model->type);
                        },
                    ],
                    'value',
                    [
                        'attribute' => 'ttl',
                        'options' => [
                            'style' => 'width: 5%;',
                        ],
                    ],
                    'actions',
                ],
            ]); ?>
        </div>
    </div>

<?php
Pjax::end();
