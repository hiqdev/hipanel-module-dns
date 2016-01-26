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
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\ValidationAsset;
use yii\web\JsExpression;

/**
 * Validates value of MX record.
 */
class MxValueValidator extends FqdnValueValidator
{
    /**
     * {@inheritdoc}
     */
    public $patternWithPriority = '/^((\d+)\s)?(([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*(.?))$/';

    /**
     * @var string pattern to extract
     */
    public $priorityExtractPattern = '/^((\d+)\s)?(.+)$/';

    /**
     * @var string name of attribute that represents priority
     */
    public $priorityAttribute = 'no';

    /**
     * {@inheritdoc}
     */
    public function validateAttribute($model, $attribute)
    {
        $this->extractPriority($model, $attribute);
        parent::validateAttribute($model, $attribute);
    }

    /**
     * Extracts priority to separated model attribute.
     *
     * @param $model Model
     * @param $attribute
     */
    public function extractPriority($model, $attribute)
    {
        $priorityAttribute = $this->priorityAttribute;
        preg_match($this->priorityExtractPattern, $model->$attribute, $matches);
        if ($matches[2] !== '') {
            $model->$priorityAttribute = $matches[2];
            $model->$attribute = $matches[3];
        }
    }

    /**
     * Uses [[patternWithPriority]] instead of [[pattern]]
     * {@inheritdoc}
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $pattern = Html::escapeJsRegularExpression($this->patternWithPriority);

        $options = [
            'pattern' => new JsExpression($pattern),
            'not' => $this->not,
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ], Yii::$app->language),
        ];
        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        ValidationAsset::register($view);

        return 'yii.validation.regularExpression(value, messages, ' . Json::htmlEncode($options) . ');';
    }
}
