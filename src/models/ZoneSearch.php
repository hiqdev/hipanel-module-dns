<?php

namespace hipanel\modules\dns\models;

use hipanel\helpers\ArrayHelper;
use Yii;

class ZoneSearch extends Zone
{
    use \hipanel\base\SearchModelTrait {
        searchAttributes as defaultSearchAttributes;
    }

    /**
     * @inheritdoc
     */
    public function searchAttributes()
    {
        return ArrayHelper::merge($this->defaultSearchAttributes(), [
            'nss_like' => Yii::t('app', 'NS servers'),
        ]);
    }
}
