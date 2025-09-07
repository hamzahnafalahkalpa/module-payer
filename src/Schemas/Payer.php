<?php

namespace Hanafalah\ModulePayer\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Hanafalah\ModulePayer\Contracts\Data\PayerData;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;
use Illuminate\Database\Eloquent\Model;

class Payer extends Company implements Contracts\Payer
{
    protected string $__entity = 'Payer';
    public $payer_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'payer',
            'tags'     => ['payer', 'payer-index'],
            'duration' => 24 * 60 
        ]
    ];

    public function prepareStorePayer(PayerData $payer_dto): Model{
        $payer = $this->prepareStoreCompany($payer_dto);

        return $this->payer_model = $payer;
    }

    public function payer(mixed $conditionals = null): Builder{
        return $this->company($conditionals)->where('props->is_payer_able',true);
    }
}
