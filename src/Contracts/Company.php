<?php

namespace Hanafalah\ModulePayer\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

interface Company extends DataManagement
{
    public function getCompany(): mixed;
    public function prepareShowCompany(?Model $model = null): ?Model;
    public function showCompany(?Model $model = null): array;
    public function prepareStoreCompany(?array $attributes = null): Model;
    public function storeCompany(): array;
    public function prepareViewCompanyList(): Collection;
    public function viewCompanyList(): array;
    public function prepareViewCompanyPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator;
    public function viewCompanyPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array;
    public function company($conditionals = null): Builder;
    public function prepareDeleteCompany(?array $attributes = null): bool;
    public function deleteCompany(): bool;
}
