<?php

use hipanel\modules\dns\grid\RecordGridView;
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use hipanel\widgets\Pjax;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Zone $model
 * @var ArrayDataProvider $recordsDataProvider
 */

$this->title                    = $model->idn;
$this->params['subtitle']       = Yii::t('hipanel:dns', 'DNS zone for domain {domain}', ['domain' => $model->idn]) . ' #' . $model->id;
$this->params['breadcrumbs'][]  = ['label' => Yii::t('hipanel:dns', 'DNS'), 'url' => ['@dns/zone/index']];
$this->params['breadcrumbs'][]  = $this->title;

Pjax::begin([
    'id' => 'dns_zone_view',
    'enablePushState' => false,
]);

$this->registerCss(<<<CSS
@media screen and (max-width: 767px) {
    .table-responsive > .table > tbody > tr > td {
         white-space: inherit !important;
    }
}
CSS
);

$records = $recordsDataProvider->getModels();

$ns_servers = [];
foreach ($records as $record) {
    if ($record->type === 'ns' && $record->service_id) {
        $ns_servers[] = $record['value'];
    }
}
sort($ns_servers);

?>

<?php if ((!$model->is_served && count($ns_servers)) || count($ns_servers) === 0) : ?>
    <div class="alert alert-warning alert-dismissible fade in" role="alert">
        <?php if ($model->isDomainRegisteredInPanel()) : ?>
            <h4><i class="fa fa-warning-circle"></i>&nbsp;&nbsp;<?= Yii::t('hipanel:dns', 'Set NS servers for domain {domain}', ['domain' => $model->reg_domain]) ?></h4>

            <p>
                <?= Yii::t('hipanel:dns', 'This DNS zone belongs to domain {domain_link}, but it is not configured properly. To make these DNS records work, please change NS servers of domain to {ns_servers}.', [
                    'domain_link' => Yii::getAlias('@domain', false)
                        ? Html::a($model->reg_domain, ['@domain/view', 'id' => $model->reg_domain_id], ['data-pjax' => 0])
                        : $model->reg_domain,
                    'ns_servers' => Html::tag('code', implode(', ', $ns_servers ?: Yii::$app->params['module.dns.default.nss'])),
                ]) ?>
            </p>
        <?php else : ?>
            <h4><i class="fa fa-warning-circle"></i>&nbsp;&nbsp;<?= Yii::t('hipanel:dns', 'Make sure correct NS records for {domain} are set', ['domain' => $model->idn]) ?></h4>

            <p>
                <?= Yii::t('hipanel:dns', 'To make these DNS records work, make sure to set {ns_servers} as the NS servers for {domain}.', [
                    'domain' => $model->idn,
                    'ns_servers' => Html::tag('code', implode(', ', $ns_servers)),
                ]) ?>
            </p>
        <?php endif ?>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-md-12">
        <?php
        $exampleModel = new Record([
            'domain' => $model->domain,
            'idn' => $model->idn,
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
        <?php $recordsForGridDataProvider = clone $recordsDataProvider; ?>
        <?php $recordsForGridDataProvider->setModels(array_filter($recordsForGridDataProvider->getModels(), function (Record $model) {
            return Yii::$app->user->can('support') || $model->type !== 'ns' || !$model->is_system;
        })) ?>
        <?= RecordGridView::widget([
            'dataProvider' => $recordsForGridDataProvider,
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
