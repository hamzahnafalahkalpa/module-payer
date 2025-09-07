<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModuleOrganization\Models\Organization;
use Hanafalah\ModulePayer\Resources\Company\ShowCompany;
use Hanafalah\ModulePayer\Resources\Company\ViewCompany;
use Hanafalah\ModulePayment\Concerns\{
    HasPaymentSummaryDeferred, HasUserWallet
};

class Company extends Organization
{
    use HasPaymentSummaryDeferred, HasUserWallet;

    protected $table = 'unicodes';

    public function viewUsingRelation(): array
    {
        return [];
    }

    public function showUsingRelation(): array
    {
        return ['parent'];
    }

    public function getShowResource(){
        return ShowCompany::class;
    }

    public function getViewResource(){
        return ViewCompany::class;
    }
}
