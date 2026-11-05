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

/**
 * Collection of DNS records that keeps the API response of the last save.
 *
 * The API does not add a record that already exists in the zone: it returns the existing one
 * marked with `is_duplicate`. Collection copies only the id to the models, so the response is
 * kept to tell the user which records were skipped.
 */
class RecordCollection extends Collection
{
    /**
     * @var array API response of the last save, indexed like the models
     */
    private array $lastResults = [];

    protected function performOperation(string $command, array $data, array $queryOptions = []): array
    {
        return $this->lastResults = parent::performOperation($command, $data, $queryOptions);
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
}
