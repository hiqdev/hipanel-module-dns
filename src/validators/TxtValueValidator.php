<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\validators;

use Yii;
use yii\validators\RegularExpressionValidator;

/**
 * Validates value of TXT record.
 */
class TxtValueValidator extends RegularExpressionValidator
{
    /**
     * {@inheritdoc}
     */
    public $pattern = '/^[\x20-\x7e]+$/';

    public function init()
    {
        if ($this->message === null) {
            $this->message = Yii::t('hipanel:dns', '{attribute} is invalid. Only printable ASCII characters (Latin letters, digits, spaces and punctuation) are allowed');
        }
        parent::init();
    }

    /**
     * Converts a TXT value given in zone presentation format (one or more double-quoted strings,
     * e.g. `"v=spf1 -all"` or `"part1" "part2"`) into the plain text the record should contain.
     * Any other value is returned as is.
     *
     * @param string|null $value
     * @return string
     */
    public static function normalize($value): string
    {
        $value = trim((string)$value);
        $string = '"(?:[^"\\\\]|\\\\.)*"';
        if (!preg_match('/^' . $string . '(?:\s+' . $string . ')*$/s', $value)) {
            return $value;
        }

        preg_match_all('/"((?:[^"\\\\]|\\\\.)*)"/s', $value, $matches);

        $res = '';
        foreach ($matches[1] as $part) {
            $res .= preg_replace_callback(
                '/\\\\(\d{3}|.)/s',
                static function (array $m): string {
                    return strlen($m[1]) === 3 ? chr(((int)$m[1]) % 256) : $m[1];
                },
                $part
            );
        }

        return $res;
    }

    /**
     * Renders the value as one or more double-quoted strings of at most 255 bytes,
     * with `"` and `\` escaped, as it is written to zone files.
     *
     * @param string $value
     * @return string
     */
    public static function toPresentation($value): string
    {
        $chunks = str_split(static::normalize($value), 255) ?: [''];

        return implode(' ', array_map(static function (string $chunk): string {
            return '"' . addcslashes($chunk, '"\\') . '"';
        }, $chunks));
    }
}
