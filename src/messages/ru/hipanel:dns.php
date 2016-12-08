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
    'DNS' => 'DNS',
    'Domains' => 'Домены',
    'Zone' => 'Зона',
    'DNS zones' => 'DNS зоны',
    'NS servers' => 'NS сервера',
    'Enabled' => 'Включен',
    'Disabled' => 'Отключен',
    'Means that the panel will publish DNS records on the NS servers' => 'Означает, что панель будет публиковать DNS записи на NS сервера',
    'DNS zone for domain {domain}' => 'DNS зона для домена {domain}',
    'Export DNS records' => 'Экспортировать DNS записи',
    'Confirm DNS record deleting' => 'Подтвердите удаление DNS записи',
    'Delete record' => 'Удалить запись',
    'Deleting record...' => 'Удаление записи...',
    'Are you sure, that you want to delete record {name}?' => 'Вы действительно хотите удалить запись {name}?',
    '{attribute} is not a valid domain name part' => '{attribute} не является правильной частью доменного имени',
    '{attribute} is not a valid domain name' => '{attribute} не является правильным доменом',
    'TTL' => 'TTL',
    'Value' => 'Значение',
    'Name' => 'Имя',
    'Registered domain' => 'Загегистрированным доменом',
    'Bound to' => 'Связан с',
    'Set NS servers for domain {domain}' => 'Установите NS сервера для домена {domain}',
    'This DNS zone belongs to domain {domain_link}, but it is not configured properly. To make these DNS records work, please change NS servers of domain to {ns_servers}.' => 'Эта DNS зона относится к зарегистрированнму доменму {domain_link}, но он не настроен правильно. Для того, чтобы эти записи работали, пожалуйста, установите следующие NS сервера в настройках домена {ns_servers}.',
    '{0, plural, one{DNS record} other{# DNS records}} updated successfully' => '{0, plural, one{DNS запись успешно обновлена} few{# DNS записи успешно обновлено} other{# DNS записей успешно обновлено}}',
    '{0, plural, one{DNS record} other{# DNS records}} deleted successfully' => '{0, plural, one{DNS запись успешно удалена} few{# DNS записи успешно удалено} other{# DNS записей успешно удалено}}',
    '{0, plural, one{DNS record} other{# DNS records}} created successfully' => '{0, plural, one{DNS запись успешно создана} few{# DNS записи успешно созданы} other{# DNS заспией успешно создано}}',
    'DNS records export' => 'Экспорт DNS записей',
    'Select record types you want to export' => 'Выберите типы записей, которые вы хотите экспортировать',
    'This record was created by hosting panel automatically and cannot be updated' => 'Эта запись была создана хостинговой панелью автоматически и не может быть изменена',
    'This record is important for the domain zone viability and can not be deleted' => 'Эта запись необходима для работы доменной зоны и не может быть удалена',

    '{attribute} must be a valid IP address.' => 'Значение должно быть правильным IP адресом.',
    '{attribute} must not be an IPv4 address.' => 'Значение не должно быть IPv4 адресом.',
    '{attribute} must not be an IPv6 address.' => 'Значение не должно быть IPv6 адресом.',
    '{attribute} is not a valid email address.' => 'Значение не является правильным email адресом.',
    '{attribute} is invalid.' => 'Значение  неверно.',
];
