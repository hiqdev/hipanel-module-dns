<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\validators;

use hipanel\validators\DomainValidator;
use Yii;

/**
 * Validates value of FQDN record.
 */
class FqdnValueValidator extends DomainValidator
{
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*(\.?)$/';

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
        parent::validateAttribute($model, $attribute);
        if (empty($this->errors) && $this->trimTrailingDot) {
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
