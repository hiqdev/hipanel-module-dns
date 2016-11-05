<?php

/*
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

return [
    'aliases' => [
        '@dns' => '/dns/',
    ],
    'modules' => [
        'dns' => [
            'class' => \hipanel\modules\dns\Module::class,
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'hipanel:dns' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@hipanel/modules/dns/messages',
                ],
            ],
        ],
        'menuManager' => [
            'items' => [
                'sidebar' => [
                    'add' => [
                        'dns' => [
                            'menu' => \hipanel\modules\dns\menus\SidebarMenu::class,
                            'where' => [
                                'before' => ['server', 'domains'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
