<?php

namespace Hanafalah\ModulePayer\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;
use Illuminate\Database\Eloquent\Model;

class Payer extends Organization implements Contracts\Payer
{
    protected array $__guard   = ['id'];
    protected array $__add     = ['name', 'flag', 'parent_id', 'props'];
    protected string $__entity = 'Payer';
    public static $payer_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'payer',
            'tags'     => ['payer', 'payer-index'],
            'forever'  => true
        ]
    ];

    protected function viewUsingRelation(){
        return [];
    }

    protected function showUsingRelation(){
        return [];
    }

    public function getPayer(): mixed{
        return static::$payer_model;
    }

    public function prepareShowPayer(?Model $model = null, ? array $attributes = null): ?Model{
        $attributes ??= \request()->all();

        $model ??= $this->getPayer();
        if (!isset($model)){
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('Id not found');
            $model = $this->payer()->with($this->showUsingRelation())->findOrFail($id);
        }else{
            $model->load($this->showUsingRelation());
        }
        return static::$payer_model = $model;
    }

    public function showPayer(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            $this->prepareShowPayer($model);
        });
    }

    private function localAddSuffixCache(mixed $suffix): void{
        $this->addSuffixCache($this->__cache['index'], "payer-index", $suffix);
    }

    public function prepareViewPayerList(?array $attributes = null): Collection{
        $attributes ??= request()->all();
        if (isset($attributes['flag'])) {
            $attributes['flag'] = $this->mustArray($attributes['flag']);
            $this->localAddSuffixCache(implode('-', $attributes['flag']));
        }
        return static::$payer_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () use ($attributes) {
            return $this->payer()->when(isset($attributes['flag']), function ($query) use ($attributes) {
                $query->flagIn($attributes['flag']);
            })->orderBy('name', 'asc')->get();
        });
    }

    public function viewPayerList(): array{
        return $this->viewEntityResource(function() {
            return $this->prepareViewPayerList();
        });
    }

    public function payer(mixed $conditionals = []): Builder{
        $this->booting();
        return $this->PayerModel()->conditionals($this->mergeCondition($conditionals ?? []))->withParameters()->orderBy('name', 'asc');
    }
}
