<?php

/*
 * Hipanel Module Dns
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns;

class Plugin extends \hiqdev\pluginmanager\Plugin
{
    protected $_items = [
        'aliases' => [
            '@dns' => '/dns/',
        ],
        'menus' => [
            'hipanel\modules\dns\SidebarMenu',
        ],
        'modules' => [
            'dns' => [
                'class' => 'hipanel\modules\dns\Module',
            ],
        ],
        'components' => [
            'i18n' => [
                'translations' => [
                    'hipanel/dns' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@hipanel/modules/dns/messages',
                        'fileMap' => [
                            'hipanel/dns' => 'dns.php'
                        ],
                    ],
                ],
            ],
        ],
    ];
}
