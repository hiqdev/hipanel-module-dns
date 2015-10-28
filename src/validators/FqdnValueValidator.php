<?php

namespace hipanel\modules\dns\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Validates value of FQDN record
 *
 * @package hipanel\modules\dns\validators
 */
class FqdnValueValidator extends RegularExpressionValidator
{
    /**
     * @inheritdoc
     */
    public $pattern = '/^([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*(.?)$/';

    /**
     * Whether to remove trailing `.` character.
     * @var boolean
     */
    public $trimTrailingDot = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->message = \Yii::t('app', '{attribute} does not look like a valid domain name');
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        $result = $this->validateValue($model->$attribute);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        } elseif ($this->trimTrailingDot) {
            $model->$attribute = $this->trimTrainingDot($model->$attribute);
        }
    }

    /**
     * Removes trailing dot
     * @param $value
     * @return string
     */
    public function trimTrainingDot($value)
    {
        return rtrim($value, '.');
    }
}