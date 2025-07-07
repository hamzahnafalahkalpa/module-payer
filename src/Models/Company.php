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

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('flag',function($query){
            $query->flagIn('Company');
        });
        static::creating(function ($query) {
            $query->flag = 'Company';
        });
    }

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
