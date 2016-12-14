<?php

/*
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\grid;

use hipanel\grid\ActionColumn;
use hipanel\grid\MainColumn;
use hipanel\modules\dns\menus\DnsActionsMenu;
use hipanel\widgets\ArraySpoiler;
use hipanel\widgets\Label;
use hiqdev\menumanager\MenuColumn;
use Yii;
use yii\bootstrap\Html;

class ZoneGridView extends \hipanel\grid\BoxedGridView
{
    public static function defaultColumns()
    {
        return [
            'zone' => [
                'class' => MainColumn::className(),
                'label' => Yii::t('hipanel:dns', 'Zone'),
                'attribute' => 'name',
            ],
            'domain' => [
                'class' => MainColumn::className(),
                'filterAttribute' => 'domain_like',
            ],
            'idn' => [
                'class' => MainColumn::className(),
                'filterAttribute' => 'idn_like',
            ],
            'actions' => [
                'class' => MenuColumn::class,
                'menuClass' => DnsActionsMenu::class,
            ],
            'nss' => [
                'format' => 'raw',
                'attribute' => 'nss_like',
                'label' => Yii::t('hipanel:dns', 'NS servers'),
                'value' => function ($model) {
                    return ArraySpoiler::widget(['data' => $model->nss]);
                },
            ],
            'dns_on' => [
                'format' => 'raw',
                'filter' => function ($column, $model, $attribute) {
                    return Html::activeDropDownList($model, $attribute, [
                        '' => Yii::t('hipanel:dns', '---'),
                        '1' => Yii::t('hipanel:dns', 'Enabled'),
                        '0' => Yii::t('hipanel:dns', 'Disabled'),
                    ], [
                        'class'     => 'form-control',
                    ]);
                },
                'value' => function ($model) {
                    return Label::widget([
                        'color' => $model->dns_on ? 'success' : '',
                        'label' => $model->dns_on ? Yii::t('hipanel:dns', 'Enabled') : Yii::t('hipanel:dns', 'Disabled'),
                        'labelOptions' => [
                            'title' => Yii::t('hipanel:dns', 'Means that the panel will publish DNS records on the NS servers'),
                        ],
                    ]);
                },
            ],
            'bound_to' => [
                'format' => 'raw',
                'label' => Yii::t('hipanel:dns', 'Bound to'),
                'value' => function ($model) {
                    if (Yii::getAlias('@domain') !== null && $model->is_reg_domain) {
                        return Html::a(Yii::t('hipanel:dns', 'Registered domain'), ['@domain/view', 'id' => $model->id]);
                    } elseif ($model->server_id) {
                        return Html::a($model->account . '@' . $model->server, ['@hdomain/view', 'id' => $model->id]);
                    } else {
                        return Yii::$app->formatter->nullDisplay;
                    }
                },
            ],
        ];
    }
}
