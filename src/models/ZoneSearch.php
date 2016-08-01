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

use hipanel\helpers\ArrayHelper;
use Yii;

class ZoneSearch extends Zone
{
    use \hipanel\base\SearchModelTrait {
        searchAttributes as defaultSearchAttributes;
    }

    /**
     * {@inheritdoc}
     */
    public function searchAttributes()
    {
        return ArrayHelper::merge($this->defaultSearchAttributes(), [
            'nss_like'      => Yii::t('hipanel', 'Name Servers'),
            'domain_like'   => Yii::t('hipanel', 'Domain'),
        ]);
    }
}
