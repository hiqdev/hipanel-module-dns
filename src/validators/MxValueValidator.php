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

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\PunycodeAsset;
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
    public $patternWithPriority = '/^(\d{1,5})\s+(([a-z0-9][a-z0-9-]*\.)+[a-z0-9][a-z0-9-]*\.?)$/';

    /**
     * @var string pattern to extract
     */
    public $priorityExtractPattern = '/^((\d+)\s+)?(.+)$/';

    /**
     * @var int minimal value of the priority. 0 can not be used: the DB replaces it with the next free number
     */
    public $minPriority = 1;

    /**
     * @var int maximal value of the priority
     */
    public $maxPriority = 65535;

    /**
     * @var string|null error message when the priority is missing or invalid
     */
    public $priorityMessage;

    /**
     * @var string name of attribute that represents priority
     */
    public $priorityAttribute = 'no';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->priorityMessage === null) {
            $this->priorityMessage = Yii::t('hipanel:dns', '{attribute} must start with the priority from {min} to {max}, e.g. "10 mail.example.com"', [
                'min' => $this->minPriority,
                'max' => $this->maxPriority,
            ]);
        }
    }

    public function validateAttribute($model, $attribute)
    {
        $model->$attribute = static::convertAsciiToIdn(mb_strtolower($model->$attribute));
        $this->extractPriority($model, $attribute);

        $priority = $model->{$this->priorityAttribute};
        if ($priority === null || $priority === '' || !ctype_digit((string)$priority) || (int)$priority < $this->minPriority || (int)$priority > $this->maxPriority) {
            $this->addError($model, $attribute, $this->priorityMessage);

            return;
        }

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

        $options = array_filter([
            'pattern' => new JsExpression($pattern),
            'not' => $this->not,
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ], Yii::$app->language),
            'skipOnEmpty' => $this->skipOnEmpty ? 1 : null,
        ]);
        PunycodeAsset::register($view);
        ValidationAsset::register($view);

        $priorityMessage = Yii::$app->getI18n()->format($this->priorityMessage, [
            'attribute' => $model->getAttributeLabel($attribute),
        ], Yii::$app->language);
        $minPriority = (int)$this->minPriority;
        $maxPriority = (int)$this->maxPriority;

        return 'value = punycode.toASCII(value.toLowerCase());'
            . ' var mxPriority = /^(\\d+)\\s/.exec(value);'
            . ' if (value.length && (!mxPriority || parseInt(mxPriority[1], 10) < ' . $minPriority . ' || parseInt(mxPriority[1], 10) > ' . $maxPriority . ')) {'
            . ' messages.push(' . Json::htmlEncode($priorityMessage) . ');'
            . ' } else {'
            . ' yii.validation.regularExpression(value, messages, ' . Json::htmlEncode($options) . ');'
            . ' }';
    }
}
