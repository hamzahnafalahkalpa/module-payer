<?php

namespace Hanafalah\ModulePayer\Contracts\Schemas;

use Hanafalah\ModuleOrganization\Contracts\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Data\CompanyData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleOrganization\Schemas\Company
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method array storeCompany(?CompanyData $rab_work_list_dto = null)
 * @method bool deleteCompany()
 * @method bool prepareDeleteCompany(? array $attributes = null)
 * @method mixed getCompany()
 * @method ?Model prepareShowCompany(?Model $model = null, ?array $attributes = null)
 * @method array showCompany(?Model $model = null)
 * @method array viewCompanyList()
 * @method Collection prepareViewCompanyList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewCompanyPaginate(PaginateData $paginate_dto)
 * @method array viewCompanyPaginate(?PaginateData $paginate_dto = null)
 */
interface Company extends Organization
{
    public function prepareStoreCompany(CompanyData $company_dto): Model;
    public function company(mixed $conditionals = null): Builder;
}
