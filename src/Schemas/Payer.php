<?php

namespace Hanafalah\ModulePayer\Schemas;

use Hanafalah\ModuleOrganization\{
    Schemas\Organization
};
use Hanafalah\ModulePayer\Contracts;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Collection,
};
use Illuminate\Pagination\LengthAwarePaginator;

class Payer extends Organization implements Contracts\Payer
{
    protected string $__entity = 'Payer';
    public static $payer_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'payer',
            'tags'     => ['payer', 'payer-index'],
            'forever'  => true
        ]
    ];

    public function getPayer(): mixed
    {
        return static::$payer_model;
    }

    protected function showUsingRelation(): array
    {
        return [];
    }

    public function prepareShowPayer(?Model $model = null): ?Model
    {
        $this->booting();

        $model ??= $this->getPayer();
        if (!isset($model)) {
            $id = request()->id;
            if (!request()->has('id')) throw new \Exception('No id provided', 422);

            $model = $this->payer()->with($this->showUsingRelation())->find($id);
        } else {
            $model->load($this->showUsingRelation());
        }

        return static::$payer_model = $model;
    }

    public function showPayer(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowPayer($model);
        });
    }

    public function prepareStorePayer(?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        $payer = $this->PayerModel();
        if (isset($attributes['id'])) $payer = $payer->find($attributes['id']);

        $exceptions = [];
        foreach ($attributes as $key => $attribute) {
            if ($this->inArray($key, $exceptions)) continue;
            $payer->{$key} = $attribute;
        }
        $payer->save();

        static::$payer_model = $payer;
        $this->forgetTags(['payer', 'organization']);

        return $payer;
    }

    public function storePayer(): array
    {
        return $this->transaction(function () {
            return $this->showPayer($this->prepareStorePayer());
        });
    }

    public function prepareViewPayerList(): Collection
    {
        return static::$payer_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            return $this->payer()->orderBy('name', 'asc')->get();
        });
    }

    public function viewPayerList(): array
    {
        return $this->transforming($this->__resources['index'], function () {
            return $this->prepareViewPayerList();
        });
    }

    private function localAddSuffixCache(mixed $suffix): void
    {
        $this->addSuffixCache($this->__cache['index'], "payer-index", $suffix);
    }

    public function prepareViewPayerPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        $this->localAddSuffixCache('paginate');
        return $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () use ($paginate_options) {
            return $this->payer()->paginate(...$this->arrayValues($paginate_options))
                ->appends(request()->all());
        });
    }

    public function viewPayerPaginate(int $perPage = 50, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        return $this->transforming($this->__resources['view'], function () use ($paginate_options) {
            return $this->prepareViewPayerPaginate(...$this->arrayValues($paginate_options));
        });
    }

    public function get(mixed $conditionals = null): Collection
    {
        return $this->payer()->get();
    }

    public function refind($id = null): Model|null
    {
        return $this->payer(function ($query) use ($id) {
            $query->where($this->OrganizationModel()->getKeyName(), request()->id);
        })->first();
    }

    public function payer($conditionals = null): Builder
    {
        $this->booting();
        return $this->PayerModel()->withParameters()->conditionals($conditionals);
    }

    public function prepareDeletePayer(?array $attributes = null): bool
    {
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('No id provided', 422);
        $result = $this->PayerModel()->destroy($attributes['id']);
        $this->forgetTags(['payer', 'organization']);
        return $result;
    }

    public function deletePayer(): bool
    {
        return $this->transaction(function () {
            return $this->prepareDeletePayer();
        });
    }
}
