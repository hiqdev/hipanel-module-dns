hiqdev/hipanel-module-dns
-------------------------

## [Under development]

    - [f32b34d] 2017-02-01 Fixed typo [d.naumenko.a@gmail.com]
    - [2d7ace2] 2017-01-31 renamed scenarioActions <- scenarioCommands [@hiqsol]
    - [80462b9] 2017-01-27 renamed from -> `tableName` in ActiveRecord [@hiqsol]
    - [79ab4bc] 2017-01-27 changed index/type -> `from` in ActiveRecord [@hiqsol]
    - [d092560] 2017-01-24 fixes after redoing hiart [@hiqsol]
    - [3b3780d] 2016-12-27 Fixed table lag on mouse hovering [d.naumenko.a@gmail.com]
    - [dbc4405] 2016-12-22 redone yii2-thememanager -> yii2-menus [@hiqsol]
    - [d3aa468] 2016-12-21 moved menus definitions to DI [@hiqsol]
    - [bc0b6f7] 2016-12-19 fixed ArrayHelper::multisort -> sort [@hiqsol]
    - [167c5cf] 2016-12-14 Implemented IDN support [d.naumenko.a@gmail.com]
    - [9643e9b] 2016-12-14 translations [andreyklochok@gmail.com]
    - [d7d3817] 2016-12-14 Added translation config [andreyklochok@gmail.com]
    - [7802b1d] 2016-12-14 Enhanced HTML markup [d.naumenko.a@gmail.com]
    - [d6d3383] 2016-12-14 Enhanced HTML markup [d.naumenko.a@gmail.com]
    - [270ae46] 2016-12-14 Refactored DNS hints [d.naumenko.a@gmail.com]
    - [b684cae] 2016-12-09 Added new validation messages [andreyklochok@gmail.com]
    - [1a63f88] 2016-12-09 translation [andreyklochok@gmail.com]
    - [8cbc4d1] 2016-12-08 Added help block for SRV format [andreyklochok@gmail.com]
    - [6ce880c] 2016-12-08 translation [andreyklochok@gmail.com]
    - [2ad3658] 2016-12-08 Added error mesages for validators [andreyklochok@gmail.com]
    - [7e2aea4] 2016-12-08 translations [andreyklochok@gmail.com]
    - [7ad4556] 2016-11-29 Added new Menu [andreyklochok@gmail.com]
    - [a502cfa] 2016-11-16 DomanPartValidator now extends DomainValidator [d.naumenko.a@gmail.com]
    - [eedf642] 2016-11-15 Fixed ArrayDataProvider call to display proper column translations even when no models are present [d.naumenko.a@gmail.com]
    - [389e714] 2016-11-05 redone translation category to `hipanel:dns` <- hipanel/dns [@hiqsol]
    - [b2a0a96] 2016-11-02 Change `Cancel` button behavior in DNS management form [d.naumenko.a@gmail.com]
    - [f36c61a] 2016-10-31 fixed set-orientation [@hiqsol]
    - [47004da] 2016-10-20 Minor [d.naumenko.a@gmail.com]
    - [40845d5] 2016-10-05 Fixed DomainPartValidator. Check if message is not set and then set default messgae [andreyklochok@gmail.com]
    - [c74e815] 2016-09-22 removed unused hidev config [@hiqsol]
    - [593d044] 2016-09-22 redone menu to new style [@hiqsol]
    - [311ca75] 2016-09-22 removed old junk Plugin.php [@hiqsol]
    - [f2dc1de] 2016-08-24 redone subtitle to original Yii style [@hiqsol]
    - [03b3f4a] 2016-08-23 redone breadcrumbs to original Yii style [@hiqsol]
    - [d746fa3] 2016-08-01 fixed app -> hipanel in translations [@hiqsol]
    - [60d7696] 2016-07-21 Removed Client and Seller filters from the AdvancedSearch view for non-support [d.naumenko.a@gmail.com]
    - [1459e1b] 2016-07-14 Translation update [d.naumenko.a@gmail.com]
    - [55fb036] 2016-06-17 Change filterAttribute for DNS zones index page [d.naumenko.a@gmail.com]
    - [de7c757] 2016-06-14 Boxed view fix [andreyklochok@gmail.com]
    - [c3d5dd5] 2016-06-09 RecordGridView boxed false [andreyklochok@gmail.com]
    - [2bbce89] 2016-05-31 Change index layout [andreyklochok@gmail.com]
    - [707a4f8] 2016-05-28 Fixed RecordController not to use pagination [d.naumenko.a@gmail.com]
    - [a900f3d] 2016-05-25 Removed pagination on DNS details page [d.naumenko.a@gmail.com]
    - [5cc02c8] 2016-05-18 used composer-config-plugin and asset-packagist.org [@hiqsol]
    - [515d932] 2016-04-10 Updated translation [d.naumenko.a@gmail.com]
    - [18fcb4b] 2016-04-05 Removed hiqdev/composer-asset-plugin dependency [d.naumenko.a@gmail.com]
    - [7846a4a] 2016-03-31 fixed Travis build with `hiqdev/composer-asset-plugin` [@hiqsol]
- Added DNS records export in BIND format
    - [6f15fdd] 2016-03-30 Added DNS records export in BIND format [d.naumenko.a@gmail.com]
- Fixed minor issues
    - [f1511fe] 2016-03-16 Translations update [d.naumenko.a@gmail.com]
    - [6f38cda] 2016-03-16 Added missing translation [d.naumenko.a@gmail.com]
    - [f2c773b] 2016-03-05 RecordSearch - removed empty unused method [d.naumenko.a@gmail.com]
    - [84d4f7f] 2016-03-03 Record - update PHPDoc [d.naumenko.a@gmail.com]
    - [c89ed30] 2016-03-02 Record - update PHPDoc [d.naumenko.a@gmail.com]
    - [7e98a31] 2016-02-19 Translations updated [d.naumenko.a@gmail.com]
    - [942fe30] 2016-02-05 Record - check of record name switched to extended for `cname` records [d.naumenko.a@gmail.com]
    - [2bdf5f9] 2016-02-04 ZoneController::indexAction - removed defauls from the filterStorageMap [d.naumenko.a@gmail.com]
    - [2b96331] 2016-01-27 DNS record row - added inactive update/delete buttons [d.naumenko.a@gmail.com]
    - [23d82e6] 2016-01-27 spelling, minor [d.naumenko.a@gmail.com]
    - [de89bd1] 2016-01-26 * domain column in ZoneGridView to be main column with link to details [@hiqsol]
    - [bb07359] 2016-01-26 rehideved [@hiqsol]
    - [dd0c69a] 2016-01-22 ZoneController::IndexAction - added filterStorageMap [d.naumenko.a@gmail.com]
    - [8b691d4] 2015-12-10 Fixed DNS record edit [d.naumenko.a@gmail.com]
    - [82deeba] 2015-12-04 Classes notation changed from pathtoClassName to PHP 5.6 ClassName::class [d.naumenko.a@gmail.com]
    - [8683071] 2015-12-01 Added check for zone serving status [d.naumenko.a@gmail.com]
    - [8a0d289] 2015-11-27 Add box for info to zone view [andreyklochok@gmail.com]
- Added basics
    - [bbb4b4f] 2015-11-25 changed Plugin according to changed PluginManager [@hiqsol]
    - [2c03573] 2015-11-25 Internal IpValidator replaced with yii2 core one [d.naumenko.a@gmail.com]
    - [ae0b8b1] 2015-11-17 Added records export [d.naumenko.a@gmail.com]
    - [1b46f5a] 2015-11-16 Added module-specific translations dict, minor [d.naumenko.a@gmail.com]
    - [dd1e10b] 2015-11-09 Added `DNS_ON` filter [d.naumenko.a@gmail.com]
    - [88a8177] 2015-11-09 Controllers PHPDoc improved, added DnsZoneEditWidget [d.naumenko.a@gmail.com]
    - [884bacf] 2015-11-05 Added Flash messages for create,update,delete actions [d.naumenko.a@gmail.com]
    - [5cf1778] 2015-11-04 * code style enhanced [d.naumenko.a@gmail.com]
    - [f067e9b] 2015-11-04 Fix layout in views [andreyklochok@gmail.com]
    - [af5eade] 2015-11-04 Some beatifullness [d.naumenko.a@gmail.com]
    - [dbdfbe8] 2015-11-02 + DNS records edit [d.naumenko.a@gmail.com]
    - [a0a52d1] 2015-10-30 * Record, Zone models - changed index and type to be consistent with new API methods [d.naumenko.a@gmail.com]
    - [841c25d] 2015-10-29 + Implemeted DNS records create/delete [d.naumenko.a@gmail.com]
    - [d87a867] 2015-10-28 + Added zone/view, implemented DNS Record validation [d.naumenko.a@gmail.com]
    - [865cb5a] 2015-10-28 + Added DomainPart, FQDN, MX value, SRV value, TXT value validators [d.naumenko.a@gmail.com]
    - [b172ac1] 2015-10-28 * Added alias @dns [d.naumenko.a@gmail.com]
    - [463094e] 2015-10-26 + ZoneSearch model, index page initial work [d.naumenko.a@gmail.com]
    - [ee2adb0] 2015-10-23 Added `.php_cs` and README.md [d.naumenko.a@gmail.com]
    - [0b6b37b] 2015-10-23 Inited [d.naumenko.a@gmail.com]

## [Development started] - 2015-10-23

[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@SilverFire]: https://github.com/SilverFire
[silverfire@hiqdev.com]: https://github.com/SilverFire
[@tafid]: https://github.com/tafid
[tafid@hiqdev.com]: https://github.com/tafid
[@BladeRoot]: https://github.com/BladeRoot
[bladeroot@hiqdev.com]: https://github.com/BladeRoot
[7846a4a]: https://github.com/hiqdev/hipanel-module-dns/commit/7846a4a
[6f15fdd]: https://github.com/hiqdev/hipanel-module-dns/commit/6f15fdd
[f1511fe]: https://github.com/hiqdev/hipanel-module-dns/commit/f1511fe
[6f38cda]: https://github.com/hiqdev/hipanel-module-dns/commit/6f38cda
[f2c773b]: https://github.com/hiqdev/hipanel-module-dns/commit/f2c773b
[84d4f7f]: https://github.com/hiqdev/hipanel-module-dns/commit/84d4f7f
[c89ed30]: https://github.com/hiqdev/hipanel-module-dns/commit/c89ed30
[7e98a31]: https://github.com/hiqdev/hipanel-module-dns/commit/7e98a31
[942fe30]: https://github.com/hiqdev/hipanel-module-dns/commit/942fe30
[2bdf5f9]: https://github.com/hiqdev/hipanel-module-dns/commit/2bdf5f9
[2b96331]: https://github.com/hiqdev/hipanel-module-dns/commit/2b96331
[23d82e6]: https://github.com/hiqdev/hipanel-module-dns/commit/23d82e6
[de89bd1]: https://github.com/hiqdev/hipanel-module-dns/commit/de89bd1
[bb07359]: https://github.com/hiqdev/hipanel-module-dns/commit/bb07359
[dd0c69a]: https://github.com/hiqdev/hipanel-module-dns/commit/dd0c69a
[8b691d4]: https://github.com/hiqdev/hipanel-module-dns/commit/8b691d4
[82deeba]: https://github.com/hiqdev/hipanel-module-dns/commit/82deeba
[8683071]: https://github.com/hiqdev/hipanel-module-dns/commit/8683071
[8a0d289]: https://github.com/hiqdev/hipanel-module-dns/commit/8a0d289
[bbb4b4f]: https://github.com/hiqdev/hipanel-module-dns/commit/bbb4b4f
[2c03573]: https://github.com/hiqdev/hipanel-module-dns/commit/2c03573
[ae0b8b1]: https://github.com/hiqdev/hipanel-module-dns/commit/ae0b8b1
[1b46f5a]: https://github.com/hiqdev/hipanel-module-dns/commit/1b46f5a
[dd1e10b]: https://github.com/hiqdev/hipanel-module-dns/commit/dd1e10b
[88a8177]: https://github.com/hiqdev/hipanel-module-dns/commit/88a8177
[884bacf]: https://github.com/hiqdev/hipanel-module-dns/commit/884bacf
[5cf1778]: https://github.com/hiqdev/hipanel-module-dns/commit/5cf1778
[f067e9b]: https://github.com/hiqdev/hipanel-module-dns/commit/f067e9b
[af5eade]: https://github.com/hiqdev/hipanel-module-dns/commit/af5eade
[dbdfbe8]: https://github.com/hiqdev/hipanel-module-dns/commit/dbdfbe8
[a0a52d1]: https://github.com/hiqdev/hipanel-module-dns/commit/a0a52d1
[841c25d]: https://github.com/hiqdev/hipanel-module-dns/commit/841c25d
[d87a867]: https://github.com/hiqdev/hipanel-module-dns/commit/d87a867
[865cb5a]: https://github.com/hiqdev/hipanel-module-dns/commit/865cb5a
[b172ac1]: https://github.com/hiqdev/hipanel-module-dns/commit/b172ac1
[463094e]: https://github.com/hiqdev/hipanel-module-dns/commit/463094e
[ee2adb0]: https://github.com/hiqdev/hipanel-module-dns/commit/ee2adb0
[0b6b37b]: https://github.com/hiqdev/hipanel-module-dns/commit/0b6b37b
[f32b34d]: https://github.com/hiqdev/hipanel-module-dns/commit/f32b34d
[2d7ace2]: https://github.com/hiqdev/hipanel-module-dns/commit/2d7ace2
[80462b9]: https://github.com/hiqdev/hipanel-module-dns/commit/80462b9
[79ab4bc]: https://github.com/hiqdev/hipanel-module-dns/commit/79ab4bc
[d092560]: https://github.com/hiqdev/hipanel-module-dns/commit/d092560
[3b3780d]: https://github.com/hiqdev/hipanel-module-dns/commit/3b3780d
[dbc4405]: https://github.com/hiqdev/hipanel-module-dns/commit/dbc4405
[d3aa468]: https://github.com/hiqdev/hipanel-module-dns/commit/d3aa468
[bc0b6f7]: https://github.com/hiqdev/hipanel-module-dns/commit/bc0b6f7
[167c5cf]: https://github.com/hiqdev/hipanel-module-dns/commit/167c5cf
[9643e9b]: https://github.com/hiqdev/hipanel-module-dns/commit/9643e9b
[d7d3817]: https://github.com/hiqdev/hipanel-module-dns/commit/d7d3817
[7802b1d]: https://github.com/hiqdev/hipanel-module-dns/commit/7802b1d
[d6d3383]: https://github.com/hiqdev/hipanel-module-dns/commit/d6d3383
[270ae46]: https://github.com/hiqdev/hipanel-module-dns/commit/270ae46
[b684cae]: https://github.com/hiqdev/hipanel-module-dns/commit/b684cae
[1a63f88]: https://github.com/hiqdev/hipanel-module-dns/commit/1a63f88
[8cbc4d1]: https://github.com/hiqdev/hipanel-module-dns/commit/8cbc4d1
[6ce880c]: https://github.com/hiqdev/hipanel-module-dns/commit/6ce880c
[2ad3658]: https://github.com/hiqdev/hipanel-module-dns/commit/2ad3658
[7e2aea4]: https://github.com/hiqdev/hipanel-module-dns/commit/7e2aea4
[7ad4556]: https://github.com/hiqdev/hipanel-module-dns/commit/7ad4556
[a502cfa]: https://github.com/hiqdev/hipanel-module-dns/commit/a502cfa
[eedf642]: https://github.com/hiqdev/hipanel-module-dns/commit/eedf642
[389e714]: https://github.com/hiqdev/hipanel-module-dns/commit/389e714
[b2a0a96]: https://github.com/hiqdev/hipanel-module-dns/commit/b2a0a96
[f36c61a]: https://github.com/hiqdev/hipanel-module-dns/commit/f36c61a
[47004da]: https://github.com/hiqdev/hipanel-module-dns/commit/47004da
[40845d5]: https://github.com/hiqdev/hipanel-module-dns/commit/40845d5
[c74e815]: https://github.com/hiqdev/hipanel-module-dns/commit/c74e815
[593d044]: https://github.com/hiqdev/hipanel-module-dns/commit/593d044
[311ca75]: https://github.com/hiqdev/hipanel-module-dns/commit/311ca75
[f2dc1de]: https://github.com/hiqdev/hipanel-module-dns/commit/f2dc1de
[03b3f4a]: https://github.com/hiqdev/hipanel-module-dns/commit/03b3f4a
[d746fa3]: https://github.com/hiqdev/hipanel-module-dns/commit/d746fa3
[60d7696]: https://github.com/hiqdev/hipanel-module-dns/commit/60d7696
[1459e1b]: https://github.com/hiqdev/hipanel-module-dns/commit/1459e1b
[55fb036]: https://github.com/hiqdev/hipanel-module-dns/commit/55fb036
[de7c757]: https://github.com/hiqdev/hipanel-module-dns/commit/de7c757
[c3d5dd5]: https://github.com/hiqdev/hipanel-module-dns/commit/c3d5dd5
[2bbce89]: https://github.com/hiqdev/hipanel-module-dns/commit/2bbce89
[707a4f8]: https://github.com/hiqdev/hipanel-module-dns/commit/707a4f8
[a900f3d]: https://github.com/hiqdev/hipanel-module-dns/commit/a900f3d
[5cc02c8]: https://github.com/hiqdev/hipanel-module-dns/commit/5cc02c8
[515d932]: https://github.com/hiqdev/hipanel-module-dns/commit/515d932
[18fcb4b]: https://github.com/hiqdev/hipanel-module-dns/commit/18fcb4b
[Under development]: https://github.com/hiqdev/hipanel-module-dns/releases
