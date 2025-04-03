<?php

namespace Hanafalah\ModulePayer\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Hanafalah\ModuleOrganization\Schemas\Organization;
use Hanafalah\ModulePayer\Contracts\Data\CompanyData;
use Hanafalah\ModulePayer\Contracts\Schemas as Contracts;
use Illuminate\Database\Eloquent\Model;

class Company extends Organization implements Contracts\Company
{
    protected string $__entity = 'Company';
    public static $company_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'company',
            'tags'     => ['company', 'company-index'],
            'forever'  => true
        ]
    ];

    protected function viewUsingRelation(){
        return [];
    }

    protected function showUsingRelation(){
        return [];
    }

    public function getCompany(): mixed{
        return static::$company_model;
    }

    public function prepareShowCompany(?Model $model = null, ? array $attributes = null): ?Model{
        $attributes ??= \request()->all();

        $model ??= $this->getCompany();
        if (!isset($model)){
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('Id not found');
            $model = $this->company()->with($this->showUsingRelation())->findOrFail($id);
        }else{
            $model->load($this->showUsingRelation());
        }
        return static::$company_model = $model;
    }

    public function showCompany(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            $this->prepareShowCompany($model);
        });
    }

    public function prepareStoreCompany(CompanyData $company_dto): Model{
        $company = parent::prepareStoreOrganization($company_dto);
        $company = $this->company()->updateOrCreate([
            'id' => $company_dto->id ?? null
        ],[
            'parent_id' => $company_dto->parent_id ?? null,
            'name'      => $company_dto->name,
            'flag'      => $this->__entity
        ]);
        foreach ($company_dto->props as $key => $value) {
            $company->{$key} = $value;
        }

        $company->save();
        return static::$company_model = $company;
    }

    public function storeCompany(?CompanyData $company_dto = null): array{
        return $this->transaction(function() use ($company_dto){
            return $this->showCompany($this->prepareStoreCompany($company_dto ?? $this->requestDTO(CompanyData::class)));
        });
    }

    private function localAddSuffixCache(mixed $suffix): void{
        $this->addSuffixCache($this->__cache['index'], "company-index", $suffix);
    }

    public function prepareViewCompanyList(?array $attributes = null): Collection{
        $attributes ??= request()->all();
        if (isset($attributes['flag'])) {
            $attributes['flag'] = $this->mustArray($attributes['flag']);
            $this->localAddSuffixCache(implode('-', $attributes['flag']));
        }
        return static::$company_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () use ($attributes) {
            return $this->company()->when(isset($attributes['flag']), function ($query) use ($attributes) {
                $query->flagIn($attributes['flag']);
            })->orderBy('name', 'asc')->get();
        });
    }

    public function viewCompanyList(): array{
        return $this->viewEntityResource(function() {
            return $this->prepareViewCompanyList();
        });
    }

    public function company(mixed $conditionals = []): Builder{
        $this->booting();
        return $this->{$this->__entity.'Model'}()->conditionals($this->mergeCondition($conditionals ?? []))->withParameters()->orderBy('name', 'asc');
    }
}
