<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModuleOrganization\Models\Organization;
use Hanafalah\ModulePayer\Resources\Company\ShowCompany;
use Hanafalah\ModulePayer\Resources\Company\ViewCompany;
use Hanafalah\ModuleTransaction\Concerns\HasConsumentInvoice;
use Hanafalah\ModuleTransaction\Concerns\HasDeposit;

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

    public function toShowApi()
    {
        return new ShowCompany($this);
    }

    public function toViewApi()
    {
        return new ViewCompany($this);
    }
}
