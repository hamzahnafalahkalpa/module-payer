<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModuleOrganization\Models\Organization;
use Hanafalah\ModulePayer\Resources\Payer\ShowPayer;
use Hanafalah\ModulePayer\Resources\Payer\ViewPayer;
use Hanafalah\ModulePayment\Concerns\HasConsumentInvoice;
use Hanafalah\ModulePayment\Concerns\HasDeposit;

class Payer extends Organization
{
    use HasConsumentInvoice, HasDeposit;

    protected $table = 'organizations';

    public function getShowResource(){
        return ShowPayer::class;
    }

    public function getViewResource(){
        return ViewPayer::class;
    }
}
