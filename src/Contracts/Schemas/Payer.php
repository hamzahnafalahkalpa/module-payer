<?php

namespace Hanafalah\ModulePayer\Contracts\Schemas;

use Hanafalah\ModuleOrganization\Contracts\Schemas\Organization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Payer extends Organization
{
    public function getPayer(): mixed;
    public function prepareShowPayer(?Model $model = null, ? array $attributes = null): ?Model;
    public function showPayer(?Model $model = null): array;
    public function prepareViewPayerList(?array $attributes = null): Collection;
    public function viewPayerList(): array;
    public function payer(mixed $conditionals = []): Builder;
}
