<?php

namespace Gii\ModulePayer\Models;

use Gii\ModuleOrganization\Models\Organization;
use Gii\ModulePayer\Resources\Payer\ShowPayer;
use Gii\ModulePayer\Resources\Payer\ViewPayer;
use Zahzah\ModuleTransaction\Concerns\HasConsumentInvoice;
use Zahzah\ModuleTransaction\Concerns\HasDeposit;

class Payer extends Organization {
    use HasConsumentInvoice, HasDeposit;

    protected $table = 'organizations';

    public function toShowApi(){
        return new ShowPayer($this);
    }

    public function toViewApi(){
        return new ViewPayer($this);
    }
}