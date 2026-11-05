<?php

use hipanel\widgets\Pjax;
use yii\web\View;

/**
 * @var View $this
 */

Pjax::begin([
    'id' => 'dns_zone_view',
    'enablePushState' => false,
]);
?>
    <div class="alert alert-info" role="alert">
        <?= Yii::t('hipanel:dns', 'DNS zone for this domain does not exist') ?>
    </div>
<?php
Pjax::end();
