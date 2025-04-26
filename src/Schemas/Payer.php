<?php

namespace Hanafalah\ModulePayer\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;

class Payer extends Organization implements Contracts\Payer
{
    protected string $__entity = 'Payer';
    public static $payer_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'payer',
            'tags'     => ['payer', 'payer-index'],
            'duration' => 24 * 60 
        ]
    ];

    public function payer(mixed $conditionals = []): Builder{
        $this->booting();
        return $this->PayerModel()->conditionals($this->mergeCondition($conditionals ?? []))
                    ->withParameters()->when(isset(request()->flag), function ($query) {
                        $query->flagIn(request()->flag);
                    })->orderBy('name', 'asc');
    }
}
