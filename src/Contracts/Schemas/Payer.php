<?php

namespace Hanafalah\ModulePayer\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

interface Payer extends DataManagement
{
    public function getPayer(): mixed;
    public function prepareShowPayer(?Model $model = null): ?Model;
    public function showPayer(?Model $model = null): array;
    public function prepareStorePayer(?array $attributes = null): Model;
    public function storePayer(): array;
    public function prepareViewPayerList(): Collection;
    public function viewPayerList(): array;
    public function prepareViewPayerPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator;
    public function viewPayerPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array;
    public function get(mixed $conditionals = null): Collection;
    public function refind($id = null): Model|null;
    public function payer($conditionals = null): Builder;
    public function prepareDeletePayer(?array $attributes = null): bool;
    public function deletePayer(): bool;
}
