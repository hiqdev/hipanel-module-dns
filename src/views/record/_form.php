<?php
use hipanel\helpers\Url;
use hipanel\modules\dns\models\Record;
use hipanel\widgets\Box;
use hipanel\widgets\Pjax;
use kartik\form\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var $model Record
 * @var $this View
 */
?>

<?php $form = ActiveForm::begin([
    'id' => 'dynamic-form',
    'action' => '@dns/record/create',
    'enableAjaxValidation' => true,
    'options' => [
        'data-pjax' => true,
        'data-pjaxPush' => false
    ],
    'validationUrl' => Url::toRoute([
        '@dns/record/validate-form',
        'scenario' => $model->isNewRecord ? $model->scenario : 'update'
    ]),
]) ?>

<?php $box = Box::begin(['options' => ['class' => 'box-info']]); ?>
<div class="row record-item">
    <?php if ($model->id) {
        echo $form->field($model, 'id')->hiddenInput()->label(false);
    }
    echo $form->field($model, '[0]hdomain_id')->hiddenInput()->label(false); ?>
    <div class="col-lg-3 col-md-4">
        <?= $form->field($model, '[0]name', [
            'template' => '
                    {label}
                    <div class="input-group">
                      {input}
                      <div class="input-group-addon">.' . $model->domain . '</div>
                    </div>
                    {hint}
                    {error}
                ',
            'inputOptions' => ['data-attribute' => 'name']
        ]) ?>
    </div>
    <div class="col-lg-2 col-md-2">
        <?= $form->field($model, '[0]type', ['inputOptions' => ['data-attribute' => 'type']])->dropDownList($model->getTypes()) ?>
    </div>
    <div class="col-lg-5 col-md-4">
        <?= $form->field($model, '[0]value', ['inputOptions' => ['data-attribute' => 'value']]) ?>
    </div>
    <div class="col-lg-2 col-md-2">
        <?= $form->field($model, '[0]ttl')->dropDownList([
            60 => 60,
            600 => 600,
            3600 => 3600,
            7200 => 7200,
            86400 => 86400
        ]) ?>
    </div>
</div>
<?php $box->beginFooter();

if ($model->scenario = 'create') {
    echo Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']);
} else {
    echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default']);
}

echo '&nbsp;';
echo Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-default']);
$box->endFooter();
$box->end();
$form->end();

$this->registerJs("$('.record-item').on('change', '[data-attribute=type]', function () {
    var form = $(this).closest('form');
    var name = $(this).closest('.record-item').find('[data-attribute=name]');
    var value = $(this).closest('.record-item').find('[data-attribute=value]');

    $.each({name: name, value: value}, function (name, input) {
        if (input.val().length > 0) {
            $(form).yiiActiveForm('validateAttribute', $(input).attr('id'));
        }
    });

    return true;
});"); ?>