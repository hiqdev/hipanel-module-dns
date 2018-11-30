<?php

namespace hipanel\modules\dns\tests\acceptance\client;

use hipanel\tests\_support\Page\SidebarMenu;
use hipanel\tests\_support\Step\Acceptance\Client;

class DnsSidebarMenuCest
{
    public function ensureMenuIsOk(Client $I)
    {
        $menu = new SidebarMenu($I);

        $menu->ensureContains('Hosting',[
            'DNS' => '@dns/zone/index',
        ]);
    }
}
