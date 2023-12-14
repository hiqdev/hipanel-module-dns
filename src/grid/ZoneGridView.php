<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\grid;

use hipanel\grid\MainColumn;
use hipanel\modules\dns\menus\DnsActionsMenu;
use hipanel\widgets\ArraySpoiler;
use hipanel\widgets\Label;
use hiqdev\yii2\menus\grid\MenuColumn;
use Yii;
use yii\bootstrap\Html;

class ZoneGridView extends \hipanel\grid\BoxedGridView
{
    public function columns()
    {
        return array_merge(parent::columns(), [
            'zone' => [
                'class' => MainColumn::class,
                'label' => Yii::t('hipanel:dns', 'Zone'),
                'attribute' => 'name',
            ],
            'domain' => [
                'class' => MainColumn::class,
                'filterAttribute' => 'domain_like',
            ],
            'idn' => [
                'class' => MainColumn::class,
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
                        'class' => 'form-control',
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
                'visible' => Yii::getAlias('@hdomain', false),
            ],
            'bound_to' => [
                'format' => 'raw',
                'label' => Yii::t('hipanel:dns', 'Bound to'),
                'value' => function ($model) {
                    if (Yii::getAlias('@domain', false) && $model->reg_domain_id) {
                        return Html::a(Yii::t('hipanel:dns', 'Registered domain'), ['@domain/view', 'id' => $model->reg_domain_id]);
                    } elseif ($model->server_id) {
                        return Html::a(Html::encode($model->account) . '@' . Html::encode($model->server), ['@hdomain/view', 'id' => $model->id]);
                    } else {
                        return Yii::$app->formatter->nullDisplay;
                    }
                },
                'visible' => Yii::getAlias('@account', false),
            ],
        ]);
    }
}
