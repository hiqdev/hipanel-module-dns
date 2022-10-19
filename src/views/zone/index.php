<?php

use hipanel\modules\dns\grid\ZoneGridView;
use hipanel\modules\dns\models\Zone;
use hipanel\widgets\IndexPage;
use hiqdev\hiart\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\View;

/**
 * @var View $this
 * @var Zone $model
 * @var ArrayDataProvider $recordsDataProvider
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('hipanel:dns', 'DNS zones');
$this->params['subtitle'] = array_filter(Yii::$app->request->get($model->formName(), [])) ? Yii::t('hipanel', 'filtered list') : Yii::t('hipanel', 'full list');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $page = IndexPage::begin(['model' => $model, 'dataProvider' => $dataProvider]) ?>

    <?php $page->setSearchFormData([]) ?>

    <?php $page->beginContent('main-actions') ?>
    <?php $page->endContent() ?>

    <?php $page->beginContent('sorter-actions') ?>
        <?= $page->renderSorter([
            'attributes' => [
                'client',
                'domain', 'dns_on',
            ],
        ]) ?>
    <?php $page->endContent() ?>

    <?php $page->beginContent('bulk-actions') ?>
        <?= $page->renderBulkButton('@dns/record/export-hosts', Yii::t('hipanel:dns', 'Export DNS records'))?>
    <?php $page->endContent() ?>

    <?php $page->beginContent('table') ?>
        <?php $page->beginBulkForm() ?>
            <?= ZoneGridView::widget([
                'boxed' => false,
                'dataProvider' => $dataProvider,
                'filterModel' => $model,
                'columns' => [
                    'checkbox',
                    'client', 'idn', 'actions',
                    'nss', 'dns_on', 'bound_to',
                ],
            ]) ?>
        <?php $page->endBulkForm() ?>
    <?php $page->endContent() ?>
<?php $page->end() ?>
