<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModuleOrganization\Models\Organization;
use Hanafalah\ModulePayer\Resources\Payer\ShowPayer;
use Hanafalah\ModulePayer\Resources\Payer\ViewPayer;
use Hanafalah\ModuleTransaction\Concerns\HasConsumentInvoice;
use Hanafalah\ModuleTransaction\Concerns\HasDeposit;

class Payer extends Organization
{
    use HasConsumentInvoice, HasDeposit;

    protected $table = 'organizations';

    public function toShowApi()
    {
        return new ShowPayer($this);
    }

    public function toViewApi()
    {
        return new ViewPayer($this);
    }
}
