<?php

namespace Hanafalah\ModulePayer\Schemas;

use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;

class Company extends Organization implements Contracts\Company
{
    protected string $__entity = 'Company';
    public static $company_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'company',
            'tags'     => ['company', 'company-index'],
            'duration' => 24 * 60 
        ]
    ];
}
