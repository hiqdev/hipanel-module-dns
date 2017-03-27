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

use hipanel\validators\DomainValidator;
use Yii;

/**
 * Validates part of the domain name.
 */
class DomainPartValidator extends DomainValidator
{
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^(@|\*|([a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?(\.[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?){0,4})?|(\*\.([a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?(\.[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?){0,4})?))$/i';

    /**
     * @var string
     */
    public $extendedPattern = '/^(@|\*|([_a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?(\.[_a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?){0,4})?)$/i';

    /**
     * Whether to use [[extendedPattern]].
     * @var boolean
     */
    public $extended = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if ($this->message === null) {
            $this->message = Yii::t('hipanel:dns', '{attribute} is not a valid domain name part');
        }

        if ($this->extended) {
            $this->pattern = $this->extendedPattern;
        }

        parent::init();
    }
}
