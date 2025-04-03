<?php

namespace Hanafalah\ModulePayer\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePayer\Contracts\Data\PayerData as DataPayerData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class CompanyData extends Data implements DataPayerData{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,
    
        #[MapInputName('name')]
        #[MapName('name')]
        public string $name,
    
        #[MapInputName('flag')]
        #[MapName('flag')]
        public ?string $flag = null,
    
        #[MapInputName('parent_id')]
        #[MapName('parent_id')]
        public mixed $parent_id = null,
    
        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = []
    ){}
}