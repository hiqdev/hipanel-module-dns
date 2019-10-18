<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
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
    ],
    'container' => [
        'definitions' => [
            \hipanel\components\I18nResponseErrorFormatterInterface::class => [
                ['class' => \hipanel\components\I18nResponseErrorFormatter::class],
                ['dictionary' => 'hipanel:dns'],
            ],
            \hiqdev\thememanager\menus\AbstractSidebarMenu::class => [
                'add' => [
//                    'dns' => [
//                        'menu' => \hipanel\modules\dns\menus\SidebarMenu::class,
//                        'where' => [
//                            'before' => ['server', 'domains'],
//                        ],
//                    ],
                    'domain' => [
                        'menu' => [
                            'merge' => [
                                'dns' => [
                                    'menu' => \hipanel\modules\dns\menus\DomainSidebarSubMenu::class,
                                    'where' => [
                                        'after' => ['domains'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'hosting' => [
                        'menu' => [
                            'merge' => [
                                'dns' => [
                                    'menu' => \hipanel\modules\dns\menus\HostingSidebarSubMenu::class,
                                    'where' => [
                                        'after' => ['hdomains'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
