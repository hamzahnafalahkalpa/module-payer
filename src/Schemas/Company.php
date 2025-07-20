<?php

namespace Hanafalah\ModulePayer\Schemas;

use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Data\CompanyData;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Company extends Organization implements Contracts\Company
{
    protected string $__entity = 'Company';
    public $company_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'company',
            'tags'     => ['company', 'company-index'],
            'duration' => 24 * 60 
        ]
    ];

    public function prepareStoreCompany(CompanyData $company_dto): Model{
        $company = $this->prepareStoreOrganization($company_dto);
        return $this->company_model = $company;
    }

    public function company(mixed $conditionals = null): Builder{
        return $this->organization($conditionals);
    }
}
