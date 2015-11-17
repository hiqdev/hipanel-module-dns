<?php

namespace hipanel\modules\dns\models;

use hipanel\helpers\ArrayHelper;
use Yii;
use yii\helpers\StringHelper;

class RecordSearch extends Record
{
    use \hipanel\base\SearchModelTrait {
        searchAttributes as defaultSearchAttributes;
    }

    public function rules() {
        return [
            [['type_in', 'hdomain_id_in'], 'filter', 'filter' => function ($value) {
                $res = StringHelper::explode($value, ',', true, true);
                return $res;
            }, 'skipOnArray' => true, 'on' => ['export-hosts']],
            [['type_in'], 'default', 'value' => ['a', 'aaaa'], 'on' => ['export-hosts']],
            [['type_in'], 'each', 'rule' => ['in', 'range' => array_keys($this->getTypes())], 'on' => ['export-hosts']],
            [['hdomain_id_in'], 'required', 'on' => ['export-hosts']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function searchAttributes()
    {
        return ArrayHelper::merge($this->defaultSearchAttributes(), [
        ]);
    }
}
