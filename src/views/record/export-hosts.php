<?php

use hipanel\modules\dns\models\RecordSearch;
use hipanel\widgets\Box;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/*
 * @var $model RecordSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = Yii::t('hipanel:dns', 'DNS records export');
$this->params['breadcrumbs'][] = ['label' => Yii::t('hipanel:dns', 'DNS'), 'url' => ['@dns/zone/index']];
$this->params['breadcrumbs'][] = $this->title;

Box::begin();

$records = $dataProvider->getModels();
\yii\helpers\ArrayHelper::multisort($records, function ($record) {
    switch ($record->type) {
        case 'soa': return 1; break;
        case 'ns': return 2; break;
        case 'mx': return 3; break;
        default: return $record->id; break;
    }
});
$list = [];

foreach ($records as $record) {
    $list[] = $record->exportForBind();
}

Box::begin();
$form = \yii\widgets\ActiveForm::begin();
    echo $form->field($model, 'hdomain_id_in')->hiddenInput(['value' => implode(',', $model->hdomain_id_in)])->label(false);
    echo $form->field($model, 'type_in')->checkboxList($model->getTypes())->label(Yii::t('hipanel:dns', 'Select record types you want to export'));
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
