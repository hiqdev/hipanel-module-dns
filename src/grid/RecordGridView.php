<?php

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use hipanel\helpers\Url;
use hipanel\widgets\ModalButton;
use Yii;
use hipanel\grid\MainColumn;
use yii\helpers\Html;
use yii\web\JsExpression;

class RecordGridView extends \hipanel\grid\BoxedGridView
{
    static public function defaultColumns()
    {
        return [
            'fqdn' => [
                'attribute' => 'fqdn',
                'value' => function ($model) {
                    return $model->fqdn;
                }
            ],
            'type' => [
                'value' => function ($model) {
                    return strtoupper($model->type);
                }
            ],
            'value' => [
                'value' => function ($model) {
                    return $model->getValueText();
                }
            ],
            'zone'       => [
                'class'             => MainColumn::className(),
                'label'             => Yii::t('app', 'Zone'),
                'attribute'         => 'name',
            ],
            'actions'       => [
                'class'             => ActionColumn::className(),
                'template'          => '{delete}',
                'buttons'           => [
                    'delete'    => function ($url, $model, $key) {
                        return ModalButton::widget([
                            'model' => $model,
                            'scenario' => 'delete',
                            'submit' => ModalButton::SUBMIT_PJAX,
                            'form' => [
                                'action' => Url::to('@dns/record/delete')
                            ],
                            'button' => [
                                'label' => '<i class="fa fa-trash-o"></i> ' . Yii::t('app', 'Delete'),
                            ],
                            'modal' => [
                                'header' => Html::tag('h4', Yii::t('app', 'Confirm DNS record deleting')),
                                'headerOptions' => ['class' => 'label-info'],
                                'footer' => [
                                    'label' => Yii::t('app', 'Delete record'),
                                    'data-loading-text' => Yii::t('app', 'Deleting record...'),
                                    'class' => 'btn btn-danger',
                                ]
                            ],
                            'body' => function ($model) {
                                echo Html::activeHiddenInput($model, 'hdomain_id');
                                echo Yii::t('app', 'Are you sure, that you want to delete record {name}?', ['name' => $model->fqdn]);
                            }
                        ]);
                    }
                ]
            ],
        ];
    }
}
