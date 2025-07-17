<?php

namespace Hanafalah\ModulePayer\Data;

use Hanafalah\ModuleOrganization\Data\OrganizationData;
use Hanafalah\ModulePayer\Contracts\Data\PayerData as DataPayerData;

class PayerData extends OrganizationData implements DataPayerData{
    public static function before(array &$attributes)
    {
        $new = static::new();
        $attributes['flag'] ??= 'Company';
        if (isset($attributes['id'])){
            $organization = $new->{$attributes['flag'].'Model'}()->findOrFail($attributes['id']);
            $attributes['name'] ??= $organization->name;
            $attributes['parent_id'] ??= $organization->parent_id;
            $props = $organization->getOriginal('props') ?? [];
            foreach ($props as $key => $prop) {
                $attributes[$key] = $prop;
            }
        }
        $attributes['is_payer_able'] = true;
        parent::before($attributes);
    }
}