<?php

use hipanel\modules\dns\grid\ZoneGridView;
use hipanel\widgets\ActionBox;
use hipanel\widgets\Pjax;
use yii\helpers\Url;

$this->title = Yii::t('hipanel/dns', 'DNS zones');
$this->breadcrumbs[] = $this->title;
$this->subtitle = array_filter(Yii::$app->request->get($model->formName(), [])) ? Yii::t('hipanel', 'filtered list') : Yii::t('hipanel', 'full list');

Pjax::begin(array_merge(Yii::$app->params['pjax'], ['enablePushState' => true])); ?>

<?php $box = ActionBox::begin(['model' => $model, 'dataProvider' => $dataProvider]) ?>
    <?php $box->beginActions() ?>
        <?= $box->renderSearchButton() ?>
        <?= $box->renderSorter([
            'attributes' => [
                'client',
                'domain',
                'dns_on',
            ],
        ]) ?>
    <?php $box->endActions() ?>
    <?php $box->renderBulkActions([
        'items' => [
            $box->renderBulkButton(Yii::t('app', 'Export hosts'), Url::to(['@dns/record/export-hosts'])),
        ],
    ]) ?>
    <?= $box->renderSearchForm() ?>
    <?php $box->end() ?>

    <?php $box->beginBulkForm() ?>
        <?= ZoneGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $model,
            'columns' => [
                'checkbox',
                'client',

                'domain',
                'nss',
                'dns_on',
                'bound_to',

                'actions',
            ],
        ]) ?>
    <?php $box->endBulkForm() ?>
<?php Pjax::end();
