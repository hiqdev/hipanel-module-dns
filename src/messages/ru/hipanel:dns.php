<?php
/**
 * HiPanel DNS Module.
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

return [
    '---' => '---',
    'Are you sure, that you want to delete record {name}?' => 'Вы действительно хотите удалить запись {name}?',
    'Bound to' => 'Связан с',
    'Confirm DNS record deleting' => 'Подтвердите удаление DNS записи',
    'DNS' => 'DNS',
    'DNS records export' => 'Экспорт DNS записей',
    'Domain' => 'Домен',
    'Domains' => 'Домены',
    'Zone' => 'Зона',
    'DNS zones' => 'DNS зоны',
    'NS servers' => 'NS сервера',
    'Enabled' => 'Включен',
    'Disabled' => 'Отключен',
    'Means that the panel will publish DNS records on the NS servers' => 'Означает, что панель будет публиковать DNS записи на NS сервера',
    'DNS zone for domain {domain}' => 'DNS зона для домена {domain}',
    'Delete record' => 'Удалить запись',
    'Deleting record...' => 'Удаление записи...',
    'Email address' => 'Адрес электронной почты',
    'Example:' => 'Пример:',
    'Export DNS records' => 'Экспортировать DNS записи',
    'Format:' => 'Формат:',
    'Fully Qualified Domain Name' => 'Полное доменное имя (FQDN)',
    'IPv4 address' => 'IPv4 адрес',
    'IPv6 address' => 'IPv6 адрес',
    'Name' => 'Имя',
    'Registered domain' => 'Загегистрированным доменом',
    'Select record types you want to export' => 'Выберите типы записей, которые вы хотите экспортировать',
    'Set NS servers for domain {domain}' => 'Установите NS серверы для домена {domain}',
    'TTL' => 'TTL',
    'Text record. Usually used for SPF or DKIM records.' => 'Текстовая запись. Обычно используется для SPF или DKIM записи.',
    'This DNS zone belongs to domain {domain_link}, but it is not configured properly. To make these DNS records work, please change NS servers of domain to {ns_servers}.' => 'Эта DNS зона относится к зарегистрированнму доменму {domain_link}, но он не настроен правильно. Для того, чтобы эти записи работали, пожалуйста, установите следующие NS сервера в настройках домена {ns_servers}.',
    'This record is important for the domain zone viability and can not be deleted' => 'Эта запись необходима для работы доменной зоны и не может быть удалена',
    'This record was created by hosting panel automatically and cannot be updated' => 'Эта запись была создана хостинговой панелью автоматически и не может быть изменена',
    'Value' => 'Значение',
    '[Priority] [Fully Qualified Domain Name]' => '[Приоритет] [Полное доменное имя]',
    '[Priority] [Weight] [Port] [Fully Qualified Domain Name]' => '[Приоритет] [Вес] [Порт] [Полное доменное имя]',
    '{0, plural, one{DNS record} other{# DNS records}} created successfully' => '{0, plural, one{DNS запись успешно создана} few{# DNS записи успешно созданы} other{# DNS заспией успешно создано}}',
    '{0, plural, one{DNS record} other{# DNS records}} deleted successfully' => '{0, plural, one{DNS запись успешно удалена} few{# DNS записи успешно удалено} other{# DNS записей успешно удалено}}',
    '{0, plural, one{DNS record} other{# DNS records}} updated successfully' => '{0, plural, one{DNS запись успешно обновлена} few{# DNS записи успешно обновлено} other{# DNS записей успешно обновлено}}',
    '{attribute} is invalid.' => 'Значение неверно.',
    '{attribute} is invalid. Valid characters of the field are the letters of the Latin alphabet, and the gap separating characters' => 'Значение  неверно. Допустимыми символами поля являются буквы латинского алфавита, разделительные знаки и пробел.',
    '{attribute} is not a valid domain name' => '{attribute} не является правильным доменом',
    '{attribute} is not a valid domain name part' => '{attribute} не является правильной частью доменного имени',
    '{attribute} is not a valid email address.' => 'Значение не является правильным email адресом.',
    '{attribute} must be a valid IP address.' => 'Значение должно быть правильным IP адресом.',
    '{attribute} must be a valid IPv6 address.' => 'Значение должно быть IPv6 адресом.',
    '{attribute} must not be an IPv6 address.' => 'Значение не должно быть IPv6 адресом.',
    'To make these DNS records work, make sure to set {ns_servers} as the NS servers for {domain}.' => 'Эти DNS записи будут работать только если домену {domain} будут установлены следующие NS серверы: {ns_servers}',
    'Make sure correct NS records for {domain} are set' => 'Убедитесь в правильности NS серверов для домена {domain}',
];
