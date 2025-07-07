<?php

namespace Hanafalah\ModulePayer\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Data\PayerData;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;
use Illuminate\Database\Eloquent\Model;

class Payer extends Organization implements Contracts\Payer
{
    protected string $__entity = 'Payer';
    public static $payer_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'payer',
            'tags'     => ['payer', 'payer-index'],
            'duration' => 24 * 60 
        ]
    ];

    public function prepareStorePayer(PayerData $payer_dto): Model{
        $payer = $this->prepareStoreOrganization($payer_dto);
        return static::$payer_model = $payer;
    }

    public function payer(mixed $conditionals = []): Builder{
        return $this->generalSchemaModel($conditionals)
                    ->withParameters()->when(isset(request()->flag), function ($query) {
                        $query->flagIn(request()->flag);
                    })->where('props->is_payer_able',true);
    }
}
