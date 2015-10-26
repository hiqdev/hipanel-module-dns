<?php

namespace hipanel\modules\dns\models;

use hipanel\base\Model;
use Yii;

class Zone extends Model
{
    use \hipanel\base\ModelTrait;

    public function rules()
    {
        return [
            [['id', 'client_id', 'account_id', 'device_id'], 'integer'],
            [['domain', 'client', 'name', 'account', 'device'], 'safe'],
            [['url_fw', 'dns_on', 'is_reg_domain'], 'boolean'],
            [['nss', 'mail', 'park'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
        ]);
    }


    public function scenarioCommands()
    {
        return [
        ];
    }
}
