<?php

/*
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

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
            [['url_fw', 'dns_on', 'is_reg_domain', 'is_served'], 'boolean'],
            [['nss', 'mail', 'park'], 'safe'],
        ];
    }

    public function getRecords()
    {
        return $this->hasMany(Record::className(), ['id' => 'hdomain_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
            'dns_on' => Yii::t('hipanel/dns', 'DNS'),
            'nss' => Yii::t('hipanel/dns', 'NS servers'),
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
