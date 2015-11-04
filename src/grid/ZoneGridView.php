<?php

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use hipanel\helpers\StringHelper;
use hipanel\widgets\ArraySpoiler;
use hipanel\widgets\Label;
use Yii;
use hipanel\grid\MainColumn;
use yii\bootstrap\Html;

class ZoneGridView extends \hipanel\grid\BoxedGridView
{
    static public function defaultColumns()
    {
        return [
            'zone' => [
                'class' => MainColumn::className(),
                'label' => Yii::t('app', 'Zone'),
                'attribute' => 'name',
            ],
            'actions' => [
                'class' => ActionColumn::className(),
                'template' => '{view}'
            ],
            'nss' => [
                'format' => 'raw',
                'attribute' => 'nss_like',
                'label' => Yii::t('app', 'NS Servers'),
                'value' => function ($model) {
                    return ArraySpoiler::widget(['data' => StringHelper::explode($model->nss)]);
                }
            ],
            'dns_on' => [
                'format' => 'raw',
                'filter' => false,
                'value' => function ($model) {
                    return Label::widget([
                        'color' => $model->dns_on ? 'success' : 'Enabled',
                        'label' => $model->dns_on ? Yii::t('app', 'Active') : Yii::t('app', 'Disabled')
                    ]);
                }
            ],
        ];
    }
}
