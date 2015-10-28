<?php

namespace hipanel\modules\dns\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Validates value of SRV record
 *
 * @package hipanel\modules\dns\validators
 */
class SrvValueValidator extends RegularExpressionValidator
{
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^(([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])\s)+([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*(\.)?$/i';
}