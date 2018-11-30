<?php

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
