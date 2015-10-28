<?php

namespace hipanel\modules\dns\validators;

use Yii;
use yii\validators\RegularExpressionValidator;

/**
 * Validates value of TXT record
 *
 * @package hipanel\modules\dns\validators
 */
class TxtValueValidator extends RegularExpressionValidator {
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^[a-z0-9 _.*",?{}@!=:;\/+~\\-]+$/i';
}