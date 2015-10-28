<?php
use hipanel\modules\dns\models\Record;
use hipanel\modules\dns\models\Zone;
use yii\data\ArrayDataProvider;


/**
 * @var $model Zone
 * @var $recordsDataProvider ArrayDataProvider
 */


$this->title = $model->domain;
$this->subtitle = Yii::t('app', 'DNS zone for domain {domain}', ['domain' => $model->domain]) . ' #' . $model->id;
$this->breadcrumbs->setItems([
    ['label' => Yii::t('app', 'DNS'), 'url' => ['index']],
    $this->title,
]);

?>
<div class="row">
    <div class="col-md-12">
        <?php
        $exampleModel = new Record(['domain' => $model->domain, 'scenario' => 'create']);
        echo $this->render('_form', [
            'model' => $exampleModel
        ])
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo \hipanel\modules\dns\grid\RecordGridView::widget([
            'dataProvider' => $recordsDataProvider,
            'columns' => [
                'fqdn',
                'type',
                'value',
                'no',
                'ttl',
                'actions'
            ]
        ]); ?>
    </div>
</div>
