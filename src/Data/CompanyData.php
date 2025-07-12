<?php

namespace Hanafalah\ModulePayer\Data;

use Hanafalah\ModuleOrganization\Data\OrganizationData;
use Hanafalah\ModulePayer\Contracts\Data\CompanyData as DataCompanyData;

class CompanyData extends OrganizationData implements DataCompanyData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Company';
        parent::before($attributes);
    }
}