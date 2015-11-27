<?php
use hipanel\modules\dns\grid\RecordGridView;
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use hipanel\widgets\Pjax;
use yii\data\ArrayDataProvider;
use yii\web\View;


/**
 * @var $this View
 * @var $model Zone
 * @var $recordsDataProvider ArrayDataProvider
 */

$this->title = $model->domain;
$this->subtitle = Yii::t('hipanel/dns', 'DNS zone for domain {domain}', ['domain' => $model->domain]) . ' #' . $model->id;
$this->breadcrumbs->setItems([
    ['label' => Yii::t('hipanel/dns', 'DNS'), 'url' => ['@dns/zone/index']],
    $this->title,
]);

Pjax::begin([
    'id' => 'dns_zone_view',
    'enablePushState' => false,
]);
?>
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
            'model' => $exampleModel
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo RecordGridView::widget([
            'dataProvider' => $recordsDataProvider,
            'options' => [
                'class' => '',
            ],
            'columns' => [
                'fqdn',
                [
                    'attribute' => 'type',
                    'options' => [
                        'style' => 'width: 3%;'
                    ],
                    'value' => function ($model) {
                        return strtoupper($model->type);
                    }
                ],
                'value',
                [
                    'attribute' => 'ttl',
                    'options' => [
                        'style' => 'width: 5%;'
                    ],
                ],
                'actions'
            ]
        ]); ?>
    </div>
</div>

<?php
Pjax::end();
