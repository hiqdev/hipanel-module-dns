<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\tests\acceptance\admin;

use hipanel\tests\_support\Page\SidebarMenu;
use hipanel\tests\_support\Step\Acceptance\Admin;

class DnsSidebarMenuCest
{
    public function ensureMenuIsOk(Admin $I)
    {
        $menu = new SidebarMenu($I);

        $menu->ensureContains('Hosting',[
            'DNS' => '@dns/zone/index',
        ]);
    }
}
