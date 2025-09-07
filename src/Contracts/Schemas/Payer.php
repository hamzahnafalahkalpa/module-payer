<?php

namespace Hanafalah\ModulePayer\Contracts\Schemas;

use Hanafalah\ModuleOrganization\Contracts\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Data\PayerData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleOrganization\Schemas\Payer
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method array storePayer(?PayerData $rab_work_list_dto = null)
 * @method bool deletePayer()
 * @method bool prepareDeletePayer(? array $attributes = null)
 * @method mixed getPayer()
 * @method ?Model prepareShowPayer(?Model $model = null, ?array $attributes = null)
 * @method array showPayer(?Model $model = null)
 * @method array viewPayerList()
 * @method Collection prepareViewPayerList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewPayerPaginate(PaginateData $paginate_dto)
 * @method array viewPayerPaginate(?PaginateData $paginate_dto = null)
 */
interface Payer extends Company
{
    public function prepareStorePayer(PayerData $payer_dto): Model;
    public function payer(mixed $conditionals = []): Builder;
}
