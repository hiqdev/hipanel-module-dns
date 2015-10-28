<?php

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use Yii;
use hipanel\grid\MainColumn;

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
            'zone'       => [
                'class'             => MainColumn::className(),
                'label'             => Yii::t('app', 'Zone'),
                'attribute'         => 'name',
            ],
            'actions'       => [
                'class'             => ActionColumn::className(),
                'template'          => '{delete}'
            ],
        ];
    }
}
