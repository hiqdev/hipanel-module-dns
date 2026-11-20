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

use yii\base\UserException;

/**
 * The API rejected some records of a [[RecordCollection]]: their errors are added to the models.
 */
class RecordsNotSavedException extends UserException
{
}
