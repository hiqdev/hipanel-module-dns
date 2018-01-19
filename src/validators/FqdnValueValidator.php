<?php
/**
 * HiPanel DNS Module.
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\validators;

use Yii;
use hipanel\validators\DomainValidator;

/**
 * Validates value of FQDN record.
 */
class FqdnValueValidator extends DomainValidator
{
    /**
     * Whether to remove trailing `.` character.
     * @var boolean
     */
    public $trimTrailingDot = true;

    /**
     * @var bool
     */
    public $enableIdn = true;

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
        $result = parent::validateAttribute($model, $attribute);
        if (empty($result) && $this->trimTrailingDot) {
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
