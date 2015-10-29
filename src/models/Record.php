<?php

namespace hipanel\modules\dns\models;

use hipanel\base\Model;
use hipanel\modules\dns\validators\DomainPartValidator;
use hipanel\modules\dns\validators\FqdnValueValidator;
use hipanel\modules\dns\validators\MxValueValidator;
use hipanel\modules\dns\validators\SrvValueValidator;
use hipanel\modules\dns\validators\TxtValueValidator;
use hipanel\modules\hosting\models\Hdomain;
use hipanel\validators\IpValidator;
use Yii;
use yii\helpers\Json;
use yii\web\JsExpression;

class Record extends Model
{
    use \hipanel\base\ModelTrait;

    public static function index()
    {
        return 'dnss';
    }

    public static function type()
    {
        return 'dns';
    }

    public function rules()
    {
        return [
            [['id', 'service_id', 'server_id'], 'integer'],
            [['name', 'domain', 'type', 'fqdn', 'value', 'service', 'server'], 'safe'],
            [['is_system'], 'boolean'],

            /// TTL validation
            [['ttl'], 'integer', 'min' => 60, 'max' => 86400,
                'on' => ['create', 'update'],
            ],

            /// Name validations
            [['name'], DomainPartValidator::className(),
                'when' => $this->buildRuleWhen(['srv', 'txt'], true), 'whenClient' => $this->buildRuleWhenClient(['srv', 'txt'], true),
                'on' => ['create', 'update', 'delete']
            ],
            [['name'], DomainPartValidator::className(), 'extended' => true,
                'when' => $this->buildRuleWhen(['srv', 'txt']), 'whenClient' => $this->buildRuleWhenClient(['srv', 'txt']),
                'on' => ['create', 'update', 'delete']
            ],

            [['type'], 'in', 'range' => array_keys($this->getTypes()), 'on' => ['create', 'update']],

            /// Value validations
            /// A
            [
                ['value'], IpValidator::className(), 'ipv6' => false,
                'when' => $this->buildRuleWhen('a'), 'whenClient' => $this->buildRuleWhenClient('a'),
                'on' => ['create', 'update']
            ],

            /// AAAA
            [
                ['value'], IpValidator::className(), 'ipv4' => false,
                'when' => $this->buildRuleWhen('aaaa'), 'whenClient' => $this->buildRuleWhenClient('aaaa'),
                'on' => ['create', 'update']
            ],

            /// SOA
            [
                ['value'], 'email',
                'when' => $this->buildRuleWhen('soa'), 'whenClient' => $this->buildRuleWhenClient('soa'),
                'on' => ['create', 'update']
            ],

            /// TXT
            [
                ['value'], TxtValueValidator::className(),
                'when' => $this->buildRuleWhen('txt'), 'whenClient' => $this->buildRuleWhenClient('txt'),
                'on' => ['create', 'update']
            ],
            [
                ['value'], 'string', 'max' => 255,
                'when' => $this->buildRuleWhen('txt'), 'whenClient' => $this->buildRuleWhenClient('txt'),
                'on' => ['create', 'update']
            ],

            /// Extract `no` for MX records
            [
                ['value'], MxValueValidator::className(),
                'when' => $this->buildRuleWhen('mx'),  'whenClient' => $this->buildRuleWhenClient('mx'),
                'on' => ['create', 'update']
            ],

            /// NS, MX, CNAME
            [
                ['value'], FqdnValueValidator::className(), 'trimTrailingDot' => true,
                'when' => $this->buildRuleWhen(['ns', 'cname']),  'whenClient' => $this->buildRuleWhenClient(['ns', 'cname']),
                'on' => ['create', 'update']
            ],
            [
                ['value'], 'match', 'pattern' => '/[a-z]/i', // fqdn has no letters? Then it seems like IP
                'message' => Yii::t('app', '{attribute} does not look like a valid domain name'),
                'when' => $this->buildRuleWhen(['ns', 'mx', 'cname']),  'whenClient' => $this->buildRuleWhenClient(['ns', 'mx', 'cname']),
                'on' => ['create', 'update']
            ],

            /// SRV
            [
                ['value'], SrvValueValidator::className(),
                'when' => $this->buildRuleWhen('srv'), 'whenClient' => $this->buildRuleWhenClient('srv'),
                'on' => ['create', 'update']
            ],

            /// No
            [['no'], 'integer', 'on' => ['create', 'update']],

            /// For all:
            [['value', 'type', 'ttl'], 'required', 'on' => ['create', 'update']],
            [['id'], 'required', 'on' => ['update', 'delete']],
            [['hdomain_id'], 'required', 'on' => ['create', 'update', 'delete']],
        ];
    }

    protected function buildRuleWhen($type, $not = false) {
        return function ($model) use ($type, $not) {
            /** @var $model Record */
            return $not xor in_array($model->type, (array) $type);
        };
    }

    protected function buildRuleWhenClient($type, $not = false) {
        $not = Json::encode($not);
        $types = Json::encode((array) $type);
        return new JsExpression("
            function (attribute, value) {
                var type = $(attribute.input).closest('.record-item').find('[data-attribute=type]');
                if (!type) return true;
                var types = $types;
                return $not !== (types.indexOf(type.val()) > -1);
            }
        ");
    }

    public function getValueText() {
        return ($this->type === 'mx' ? $this->no . ' ' : '') . $this->value;
    }

    public function getTypes() {
        return [
            'a' => 'A',
            'aaaa' => 'AAAA',
            'cname' => 'CNAME',

            'txt' => 'TXT',
            'soa' => 'SOA',

            'ns' => 'NS',
            'mx' => 'MX',

            'srv' => 'SRV',
        ];
    }

    public function getRecords() {
        return $this->hasOne(Zone::className(), ['hdomain_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
            'ttl' => Yii::t('app', 'TTL'),
            'value' => Yii::t('app', 'Value'),
            'fqdn' => Yii::t('app', 'Name'),
        ]);
    }

    /**
     * @return array
     */
    public function scenarioCommands()
    {
        return [
            'create' => 'set-record',
            'update' => 'set-record',
            'delete' => 'unset-record',
        ];
    }
}
