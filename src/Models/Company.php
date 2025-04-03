<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModuleOrganization\Models\Organization;
use Hanafalah\ModulePayer\Resources\Company\ShowCompany;
use Hanafalah\ModulePayer\Resources\Company\ViewCompany;
use Hanafalah\ModulePayment\Concerns\HasConsumentInvoice;
use Hanafalah\ModulePayment\Concerns\HasDeposit;

class Company extends Organization
{
    use HasConsumentInvoice, HasDeposit;

    protected $table = 'organizations';

    protected static function booted(): void
    {
        parent::booted();
        static::creating(function ($query) {
            $query->flag = $query->getMorphClass();
        });
        static::addGlobalScope('company', function ($query) {
            $query->where('flag', (new static)->getMorphClass());
        });
    }

    public function getShowResource(){
        return ShowCompany::class;
    }

    public function getViewResource(){
        return ViewCompany::class;
    }
}
