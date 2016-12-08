<?php

use hipanel\helpers\Url;
use hipanel\modules\dns\models\Record;
use hipanel\widgets\ModalButton;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/*
 * @var $model Record
 * @var $this View
 */
?>

<?php $form = ActiveForm::begin([
    'id' => 'dynamic-form-' . ($model->id ?: time()),
    'action' => '@dns/record/' . $model->scenario,
    'enableAjaxValidation' => true,
    'options' => [
        'data-pjax' => true,
        'data-pjaxPush' => false,
    ],
    'validationUrl' => Url::toRoute([
        '@dns/record/validate-form',
        'scenario' => $model->isNewRecord ? $model->scenario : 'update',
    ]),
]) ?>
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row record-item">
                <?php
                if ($id = $model->id) {
                    echo Html::activeHiddenInput($model, "[$id]id");
                } else {
                    $id = 0;
                }
                echo Html::activeHiddenInput($model, "[$id]hdomain_id");

                ?>
                <div class="col-lg-3 col-md-4">
                    <?= $form->field($model, "[$id]name", [
                        'template' => '
                    {label}
                    <div class="input-group">
                      {input}
                      <div class="input-group-addon">.' . $model->domain . '</div>
                    </div>
                    {hint}
                    {error}
                ',
                        'inputOptions' => ['data-attribute' => 'name'],
                    ]) ?>
                </div>
                <div class="col-lg-2 col-md-2">
                    <?= $form->field($model, "[$id]type",
                        ['inputOptions' => ['data-attribute' => 'type']])->dropDownList($model->getTypes()) ?>
                </div>
                <div class="col-lg-5 col-md-4">
                    <?= $form->field($model, "[$id]value", ['inputOptions' => ['data-attribute' => 'value']]) ?>
                    <div class="srv-help">

                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <?= $form->field($model, "[$id]ttl")->dropDownList([
                        60 => 60,
                        600 => 600,
                        3600 => 3600,
                        7200 => 7200,
                        86400 => 86400,
                    ]) ?>
                </div>
            </div>


            <?php

            if ($model->scenario === 'create') {
                echo Html::submitButton(Yii::t('hipanel', 'Create'), ['class' => 'btn btn-success']);
            } else {
                echo Html::submitButton(Yii::t('hipanel', 'Save'), ['class' => 'btn btn-success']);
            }

            echo '&nbsp;';
            echo Html::button(Yii::t('hipanel', 'Cancel'), ['type' => 'reset', 'class' => 'btn btn-default btn-cancel']);
            echo '&nbsp;';

            if ($model->scenario === 'update') {
                echo ModalButton::widget([
                    'model' => $model,
                    'scenario' => 'delete',
                    'submit' => ModalButton::SUBMIT_PJAX,
                    'form' => false,
                    'button' => [
                        'tag' => 'a',
                        'label' => '<i class="fa fa-trash-o"></i> ' . Yii::t('hipanel', 'Delete'),
                        'class' => 'pull-right btn btn-default',
                    ],
                    'modal' => [
                        'header' => Html::tag('h4', Yii::t('hipanel:dns', 'Confirm DNS record deleting')),
                        'headerOptions' => ['class' => 'label-danger'],
                        'footer' => [
                            'label' => Yii::t('hipanel:dns', 'Delete record'),
                            'data-loading-text' => Yii::t('hipanel:dns', 'Deleting record...'),
                            'class' => 'btn btn-danger',
                        ],
                    ],
                    'body' => function ($model) {
                        echo Yii::t('hipanel:dns', 'Are you sure, that you want to delete record {name}?', ['name' => $model->fqdn]);
                    },
                ]);
            }
            ?>
        </div>
    </div>
<?php $form->end();
$srvHelpFormat = Yii::t('hipanel:dns', 'Format: {format}', ['format' => Html::tag('code', '[Priority] [Weight] [Port] [Fully Qualified Domain Name]')]);
$srvHelpExample = Yii::t('hipanel:dns', 'Example: {example}', ['example' => Html::tag('code', '1 10 5269 xmpp.example.com')]);
$helpMessage = implode('<br>', [$srvHelpFormat, $srvHelpExample]);
$this->registerCss('
.srv-help {
    color: #939393;
    font-size: 12px;
}
');
$this->registerJs("
$('#{$form->id} .record-item').on('change', '[data-attribute=type]', function () {
    var form = $(this).closest('form');
    var name = $(this).closest('.record-item').find('[data-attribute=name]');
    var value = $(this).closest('.record-item').find('[data-attribute=value]');

    $.each({name: name, value: value}, function (name, input) {
        if (input.val().length > 0) {
            $(form).yiiActiveForm('validateAttribute', $(input).attr('id'));
        }
    });
    
    var elem = $(this); 
    console.log(this.tagName);
    if (elem.val() === 'srv') {
        $('.srv-help').html('{$helpMessage}');
    } else {
        $('.srv-help').html('');
    }

    return true;
});

$('#{$form->id}').on('beforeSubmit', function () {
    $(this).find('.btn').attr('disabled', true);
});

"); ?>
