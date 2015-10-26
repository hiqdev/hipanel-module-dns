<?php
/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

use hipanel\widgets\ActionBox;
use hipanel\widgets\Pjax;

$this->title = Yii::t('app', 'Accounts');
$this->breadcrumbs->setItems([
    $this->title,
]);
$this->params['subtitle'] = array_filter(Yii::$app->request->get($model->formName(),
    [])) ? 'filtered list' : 'full list'; ?>

<?php Pjax::begin(array_merge(Yii::$app->params['pjax'], ['enablePushState' => true])); ?>

<?php $box = ActionBox::begin(['model' => $model, 'dataProvider' => $dataProvider]) ?>
<?php $box->beginActions() ?>
<?= $box->renderSearchButton() ?>
<?= $box->renderSorter([
    'attributes' => [],
]) ?>
<?php $box->endActions() ?>
<?php $box->beginBulkActions() ?>

<?= $box->renderDeleteButton() ?>
<?php $box->endBulkActions() ?>
<?= $box->renderSearchForm(['stateData' => $stateData, 'typeData' => $typeData]) ?>
<?php $box->end() ?>

<?php $box->beginBulkForm() ?>
<?= ZoneGridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'columns' => [
        'checkbox',
        'account',
        'client',
        'seller',
        'server',
        'state',
        'type',
        'actions',
    ],
]) ?>
<?php $box->endBulkForm() ?>
<?php Pjax::end();
