<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

error_reporting(E_ALL & ~E_NOTICE);

// The module's own vendor, or the one of the project it is installed into
$vendor = is_dir(__DIR__ . '/../vendor') ? __DIR__ . '/../vendor' : __DIR__ . '/../../..';
require_once $vendor . '/autoload.php';
require_once $vendor . '/yiisoft/yii2/Yii.php';
