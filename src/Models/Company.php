<?php

namespace Gii\ModulePayer\Models;

use Gii\ModuleOrganization\Models\Organization;
use Gii\ModulePayer\Resources\Company\ShowCompany;
use Gii\ModulePayer\Resources\Company\ViewCompany;
use Zahzah\ModuleTransaction\Concerns\HasConsumentInvoice;
use Zahzah\ModuleTransaction\Concerns\HasDeposit;

class Company extends Organization {
    use HasConsumentInvoice, HasDeposit;

    protected $table = 'organizations';

    protected static function booted(): void{
        parent::booted();
        static::creating(function($query){
            $query->flag = $query->getMorphClass();
        });
        static::addGlobalScope('company',function($query){
            $query->where('flag',(new static)->getMorphClass());
        });
    }

    public function toShowApi(){
        return new ShowCompany($this);
    }

    public function toViewApi(){
        return new ViewCompany($this);
    }
}