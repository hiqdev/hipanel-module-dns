<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\models;

use hipanel\base\Model;
use Yii;

class Zone extends Model
{
    use \hipanel\base\ModelTrait;

    public static function tableName()
    {
        return 'dnszone';
    }

    public function rules()
    {
        return [
            [['id', 'client_id', 'seller_id', 'account_id', 'server_id'], 'integer'],
            [['domain', 'idn', 'client', 'seller', 'name', 'account', 'server'], 'safe'],
            [['url_fw', 'dns_on', 'is_served', 'reg_domain', 'reg_domain_id'], 'boolean'],
            [['nss', 'mail', 'park'], 'safe'],
        ];
    }

    public function getRecords()
    {
        return $this->hasMany(Record::class, ['id' => 'hdomain_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
            'dns_on' => Yii::t('hipanel:dns', 'DNS'),
            'nss' => Yii::t('hipanel:dns', 'NS servers'),
            'idn' => Yii::t('hipanel:dns', 'Domain'),
        ]);
    }

    public function isDomainRegisteredInPanel()
    {
        return $this->is_served !== null;
    }
}
