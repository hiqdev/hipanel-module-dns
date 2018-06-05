<?php

namespace hipanel\modules\dns\tests\acceptance\seller;

use hipanel\tests\_support\Page\SidebarMenu;
use hipanel\tests\_support\Step\Acceptance\Seller;

class DnsSidebarMenuCest
{
    public function ensureMenuIsOk(Seller $I)
    {
        $menu = new SidebarMenu($I);

        $menu->ensureContains('Hosting',[
            'DNS' => '@dns/zone/index',
        ]);

        $menu->ensureContains('Domains',[
            'DNS' => '@dns/zone/index',
        ]);
    }
}
