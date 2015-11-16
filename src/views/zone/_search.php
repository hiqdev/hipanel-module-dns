<?php
use hipanel\modules\client\widgets\combo\ClientCombo;
use hipanel\modules\client\widgets\combo\SellerCombo;
use hipanel\modules\hosting\widgets\combo\SshAccountCombo;
use hipanel\modules\server\widgets\combo\ServerCombo;
use hiqdev\combo\StaticCombo;
?>

<div class="col-md-6">
    <?= $search->field('domain_like') ?>
    <?= $search->field('server')->widget(ServerCombo::className(), ['formElementSelector' => '.form-group']) ?>
    <?= $search->field('account')->widget(SshAccountCombo::className(), ['formElementSelector' => '.form-group']) ?>
</div>

<div class="col-md-6">
    <?= $search->field('client_id')->widget(ClientCombo::classname(), ['formElementSelector' => '.form-group']) ?>
    <?= $search->field('seller_id')->widget(SellerCombo::classname(), ['formElementSelector' => '.form-group']) ?>
</div>

