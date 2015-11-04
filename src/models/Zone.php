<?php

namespace hipanel\modules\dns\models;

use hipanel\base\Model;
use Yii;

class Zone extends Model
{
    use \hipanel\base\ModelTrait;

    public static function index()
    {
        return 'dnszones';
    }

    public static function type()
    {
        return 'dnszone';
    }

    public function rules()
    {
        return [
            [['id', 'client_id', 'seller_id', 'account_id', 'server_id'], 'integer'],
            [['domain', 'client', 'seller', 'name', 'account', 'server'], 'safe'],
            [['url_fw', 'dns_on', 'is_reg_domain'], 'boolean'],
            [['nss', 'mail', 'park'], 'safe'],
        ];
    }

    public function getRecords() {
        return $this->hasMany(Record::className(), ['id' => 'hdomain_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
            'dns_on' => Yii::t('app', 'DNS on'),
            'nss' => Yii::t('app', 'NS servers'),
        ]);
    }

    /**
     * @return array
     */
    public function scenarioCommands()
    {
        return [
        ];
    }
}
