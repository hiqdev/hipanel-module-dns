<?php
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use yii\data\ArrayDataProvider;


/**
 * @var $model Zone
 * @var $recordsDataProvider ArrayDataProvider
 */

\hipanel\widgets\Pjax::begin([
    'enablePushState' => false
]);

$this->title = $model->domain;
$this->subtitle = Yii::t('app', 'DNS zone for domain {domain}', ['domain' => $model->domain]) . ' #' . $model->id;
$this->breadcrumbs->setItems([
    ['label' => Yii::t('app', 'DNS'), 'url' => ['@dns/zone/index']],
    $this->title,
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
        <?php echo \hipanel\modules\dns\grid\RecordGridView::widget([
            'dataProvider' => $recordsDataProvider,
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
\hipanel\widgets\Pjax::end();