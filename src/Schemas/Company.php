<?php

namespace Hanafalah\ModulePayer\Schemas;

use Hanafalah\ModuleOrganization\{
    Schemas\Organization
};
use Hanafalah\ModulePayer\Contracts;
use Hanafalah\ModulePayer\Resources\Company\ShowCompany;
use Hanafalah\ModulePayer\Resources\Company\ViewCompany;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Collection,
};
use Illuminate\Pagination\LengthAwarePaginator;

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

    protected array $__resources = [
        'view' => ViewCompany::class,
        'show' => ShowCompany::class
    ];

    public function getCompany(): mixed
    {
        return static::$company_model;
    }

    protected function showUsingRelation(): array
    {
        return [];
    }

    public function prepareShowCompany(?Model $model = null): ?Model
    {
        $this->booting();

        $model ??= $this->getCompany();
        if (!isset($model)) {
            $id = request()->id;
            if (!request()->has('id')) throw new \Exception('No id provided', 422);

            $model = $this->company()->with($this->showUsingRelation())->find($id);
        } else {
            $model->load($this->showUsingRelation());
        }

        return static::$company_model = $model;
    }

    public function showCompany(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowCompany($model);
        });
    }

    public function prepareStoreCompany(?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        $company = $this->CompanyModel();
        if (isset($attributes['id'])) $company = $company->find($attributes['id']);

        $exceptions = [];
        foreach ($attributes as $key => $attribute) {
            if ($this->inArray($key, $exceptions)) continue;
            $company->{$key} = $attribute;
        }
        $company->save();

        static::$company_model = $company;
        $this->forgetTags(['company', 'organization']);

        return $company;
    }

    public function storeCompany(): array
    {
        return $this->transaction(function () {
            return $this->showCompany($this->prepareStoreCompany());
        });
    }

    public function prepareViewCompanyList(): Collection
    {
        return static::$company_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            return $this->company()->orderBy('name', 'asc')->get();
        });
    }

    public function viewCompanyList(): array
    {
        return $this->transforming($this->__resources['view'], function () {
            return $this->prepareViewCompanyList();
        });
    }

    private function localAddSuffixCache(mixed $suffix): void
    {
        $this->addSuffixCache($this->__cache['index'], "company-index", $suffix);
    }

    public function prepareViewCompanyPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        $this->localAddSuffixCache('paginate');
        return $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () use ($paginate_options) {
            return $this->company()->paginate(...$this->arrayValues($paginate_options))
                ->appends(request()->all());
        });
    }

    public function viewCompanyPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        return $this->transforming($this->__resources['view'], function () use ($paginate_options) {
            return $this->prepareViewCompanyPaginate(...$this->arrayValues($paginate_options));
        });
    }

    public function company($conditionals = null): Builder
    {
        $this->booting();
        return $this->CompanyModel()->withParameters()->conditionals($conditionals);
    }

    public function prepareDeleteCompany(?array $attributes = null): bool
    {
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('No id provided', 422);
        $result = $this->CompanyModel()->destroy($attributes['id']);
        $this->forgetTags(['company', 'organization']);
        return $result;
    }

    public function deleteCompany(): bool
    {
        return $this->transaction(function () {
            return $this->prepareDeleteCompany();
        });
    }
}
