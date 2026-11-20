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

use hiqdev\hiart\Collection;
use Yii;

/**
 * Collection of DNS records that reads the API result of every record.
 *
 * The API returns a result per record: either the saved record or the record with its own error,
 * the errors are not reduced to one error of the request. The collection adds each error to its
 * model, and the save fails when any record has one.
 *
 * The API does not add a record that already exists in the zone: it returns the existing one
 * marked with `is_duplicate`. The response is kept to tell the user which records were skipped.
 */
class RecordCollection extends Collection
{
    /**
     * @var array API response of the last save, indexed like the models
     */
    private array $lastResults = [];

    public function save($runValidation = true, $attributes = null, $options = [])
    {
        try {
            return parent::save($runValidation, $attributes, $options);
        } catch (RecordsNotSavedException $e) {
            return false;
        }
    }

    protected function performOperation(string $command, array $data, array $queryOptions = []): array
    {
        $this->lastResults = parent::performOperation($command, $data, $queryOptions);

        $failed = false;
        foreach ($this->models as $key => $model) {
            $result = $this->lastResults[$key] ?? null;
            if (is_array($result) && !empty($result['_error'])) {
                $model->addError('value', Yii::t('hipanel:dns', (string) $result['_error'], (array) ($result['_error_ops'] ?? [])));
                $failed = true;
            }
        }
        if ($failed) {
            // Stops the parent from treating the records as saved
            throw new RecordsNotSavedException();
        }

        return $this->lastResults;
    }

    /**
     * @return int number of records the API skipped because they already exist
     */
    public function countDuplicates(): int
    {
        $count = 0;
        foreach ($this->lastResults as $result) {
            if (is_array($result) && !empty($result['is_duplicate'])) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @return string[] an error of every record that has one, prefixed with the record
     */
    public function getRecordErrors(): array
    {
        $errors = [];
        foreach ($this->models as $model) {
            foreach ($model->getFirstErrors() as $error) {
                $record = trim(implode(' ', array_filter([$model->name ?: '@', strtoupper((string) $model->type), $model->value], 'strlen')));
                $errors[] = $record . ': ' . $error;
            }
        }

        return $errors;
    }
}
