<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use hipanel\grid\MainColumn;
use hipanel\helpers\Url;
use hipanel\widgets\ModalButton;
use Yii;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\helpers\Json;

class RecordGridView extends \hipanel\grid\BoxedGridView
{
    public static function defaultColumns()
    {
        return [
            'fqdn' => [
                'attribute' => 'idn',
                'value' => function ($model) {
                    return $model->idn_fqdn;
                },
            ],
            'type' => [
                'value' => function ($model) {
                    return strtoupper($model->type);
                },
            ],
            'value' => [
                'value' => function ($model) {
                    return $model->getValueText();
                },
            ],
            'zone'       => [
                'class'             => MainColumn::className(),
                'label'             => Yii::t('hipanel:dns', 'Zone'),
                'attribute'         => 'name',
            ],
            'actions'       => [
                'class'                => ActionColumn::className(),
                'template'             => '{update} {delete}',
                'visibleButtonsCount'  => 2,
                'options'              => [
                    'style' => 'width: 15%',
                ],
                'buttons'              => [
                    'update'    => function ($url, $model, $key) {
                        if ($model->is_system) {
                            return Html::tag('div', Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('hipanel', 'Update'), null, [
                                'class' => 'btn btn-default btn-xs disabled',
                            ]), [
                                'title' => Yii::t('hipanel:dns', 'This record was created by hosting panel automatically and cannot be updated'),
                                'style' => 'display: inline-block; cursor: not-allowed;',
                            ]);
                        }

                        $data = Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('hipanel', 'Update'), null, [
                            'class' => 'btn btn-default btn-xs edit-dns-toggle',
                            'data' => [
                                'record_id' => $model->id,
                                'hdomain_id' => $model->hdomain_id,
                                'load-url' => Url::to(['@dns/record/update', 'hdomain_id' => $model->hdomain_id, 'id' => $model->id]),
                            ],
                        ]);

                        $progress = Json::htmlEncode("<tr><td colspan='5'>" . Progress::widget([
                            'id' => 'progress-bar',
                            'percent' => 100,
                            'barOptions' => ['class' => 'active progress-bar-striped', 'style' => 'width: 100%'],
                        ]) . '</td></tr>');

                        Yii::$app->view->registerJs("
                            $('.edit-dns-toggle').click(function () {
                                var record_id = $(this).data('id');
                                var hdomain_id = $(this).data('hdomain_id');

                                var currentRow = $(this).closest('tr');
                                var newRow = $($progress);

                                $(newRow).data({'record_id': record_id, hdomain_id: hdomain_id});
                                $('tr').filter(function () { return $(this).data('id') == record_id; }).find('.btn-cancel').click();
                                $(newRow).insertAfter(currentRow);

                                jQuery.ajax({
                                    url: $(this).data('load-url'),
                                    type: 'GET',
                                    timeout: 0,
                                    error: function() {

                                    },
                                    success: function(data) {
                                        newRow.find('td').html(data);
                                        newRow.find('.btn-cancel').on('click', function (event) {
                                            event.preventDefault();
                                            newRow.remove();
                                        });
                                    }
                                });

                            });
                        ");
                        return $data;
                    },
                    'delete'    => function ($url, $model, $key) {
                        if ($model->type === 'ns' && $model->is_system) {
                            return Html::tag('div', Html::a('<i class="fa text-danger fa-trash-o"></i> ' . Yii::t('hipanel', 'Delete'), null, [
                                'class' => 'btn btn-default btn-xs disabled',
                            ]), [
                                'title' => Yii::t('hipanel:dns', 'This record is important for the domain zone viability and can not be deleted'),
                                'style' => 'display: inline-block; cursor: not-allowed;',
                            ]);
                        }

                        return ModalButton::widget([
                            'model' => $model,
                            'scenario' => 'delete',
                            'submit' => ModalButton::SUBMIT_PJAX,
                            'form' => [
                                'action' => Url::to('@dns/record/delete'),
                            ],
                            'button' => [
                                'class' => 'btn btn-default btn-xs',
                                'label' => '<i class="fa text-danger fa-trash-o"></i> ' . Yii::t('hipanel', 'Delete'),
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
                                echo Html::activeHiddenInput($model, 'hdomain_id');
                                echo Yii::t('hipanel:dns', 'Are you sure, that you want to delete record {name}?', ['name' => $model->fqdn]);
                            },
                        ]);
                    },
                ],
            ],
        ];
    }
}
