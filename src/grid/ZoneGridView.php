<?php

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use Yii;
use hipanel\grid\MainColumn;

class ZoneGridView extends \hipanel\grid\BoxedGridView
{
    static public function defaultColumns()
    {
        return [
            'zone'       => [
                'class'             => MainColumn::className(),
                'label'             => Yii::t('app', 'Zone'),
                'attribute'         => 'name',
            ],
            'actions'       => [
                'class'             => ActionColumn::className(),
                'template'          => '{view}'
            ],
        ];
    }
}
