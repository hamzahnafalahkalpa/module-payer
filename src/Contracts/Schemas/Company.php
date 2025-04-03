<?php

namespace Hanafalah\ModulePayer\Contracts\Schemas;

use Hanafalah\ModuleOrganization\Contracts\Schemas\Organization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePayer\Contracts\Data\CompanyData;

interface Company extends Organization
{
    public function getCompany(): mixed;
    public function prepareShowCompany(?Model $model = null, ? array $attributes = null): ?Model;
    public function showCompany(?Model $model = null): array;
    public function prepareStoreCompany(CompanyData $organization_dto): Model;
    public function storeCompany(?CompanyData $organization_dto = null): array;
    public function prepareViewCompanyList(?array $attributes = null): Collection;
    public function viewCompanyList(): array;
    public function company(mixed $conditionals = []): Builder;
}
