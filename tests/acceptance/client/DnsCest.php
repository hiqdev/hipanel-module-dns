<?php
/**
 * HiPanel DNS Module
 *
 * @link      https://github.com/hiqdev/hipanel-module-dns
 * @package   hipanel-module-dns
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\dns\tests\acceptance\client;

use hipanel\helpers\Url;
use hipanel\tests\_support\Page\IndexPage;
use hipanel\tests\_support\Page\Widget\Input\Input;
use hipanel\tests\_support\Page\Widget\Input\Select2;
use hipanel\tests\_support\Step\Acceptance\Client;

class DnsCest
{
    /**
     * @var IndexPage
     */
    private $index;

    public function _before(Client $I)
    {
        $this->index = new IndexPage($I);
    }

    public function ensureIndexPageWorks(Client $I)
    {
        $I->login();
        $I->needPage(Url::to('@dns/zone'));
        $I->see('DNS zones', 'h1');
        $this->ensureICanSeeAdvancedSearchBox($I);
        $this->ensureICanSeeBulkSearchBox();
    }

    private function ensureICanSeeAdvancedSearchBox(Client $I)
    {
        $this->index->containsFilters([
            Input::asAdvancedSearch($I, 'Domain'),
            Select2::asAdvancedSearch($I,'Server'),
            Select2::asAdvancedSearch($I, 'Account'),
        ]);
    }

    private function ensureICanSeeBulkSearchBox()
    {
        $this->index->containsBulkButtons([
            'Export DNS records',
        ]);
        $this->index->containsColumns([
            'Domain',
            'NS servers',
            'DNS',
            'Bound to',
        ]);
    }
}
