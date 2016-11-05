<?php

/*
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\validators;

use Yii;
use yii\validators\RegularExpressionValidator;

/**
 * Validates value of FQDN record.
 */
class FqdnValueValidator extends RegularExpressionValidator
{
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*(.?)$/';

    /**
     * Whether to remove trailing `.` character.
     * @var boolean
     */
    public $trimTrailingDot = true;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->message = Yii::t('hipanel:dns', '{attribute} is not a valid domain name');
    }

    /**
     * {@inheritdoc}
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
     * Removes trailing dot.
     * @param $value
     * @return string
     */
    public function trimTrainingDot($value)
    {
        return rtrim($value, '.');
    }
}
