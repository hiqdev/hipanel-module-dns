<?php

use hipanel\modules\dns\models\RecordSearch;
use hipanel\widgets\Box;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/*
 * @var $model RecordSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = Yii::t('hipanel/dns', 'DNS records export');
$this->breadcrumbs->setItems([
    ['label' => Yii::t('hipanel/dns', 'DNS'), 'url' => ['@dns/zone/index']],
    $this->title,
]);

Box::begin();

$list = [];

foreach ($dataProvider->getModels() as $record) {
    $list[] = $record->value . ' ' . $record->fqdn;
}

Box::begin();
$form = \yii\widgets\ActiveForm::begin();
    echo $form->field($model, 'hdomain_id_in')->hiddenInput(['value' => implode(',', $model->hdomain_id_in)])->label(false);
    echo $form->field($model, 'type_in')->checkboxList($model->getTypes())->label(Yii::t('hipanel/dns', 'Select record types you want to export'));
    echo Html::submitButton(Yii::t('hipanel', 'Export'), ['class' => 'btn btn-success']);
$form->end();
Box::end();

?>

<div class="row">
    <div class="col-md-12">
        <?= Html::textarea('', implode("\n", $list), ['rows' => count($list), 'class' => 'form-control']) ?>
    </div>
</div>

<?php
Box::end();
?>
