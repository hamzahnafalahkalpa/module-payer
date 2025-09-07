<?php

namespace Hanafalah\ModulePayer\Models;

use Hanafalah\ModulePayer\Resources\Payer\ShowPayer;
use Hanafalah\ModulePayer\Resources\Payer\ViewPayer;

class Payer extends Company
{
    protected $table = 'unicodes';

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('flag',function($query){
            $query->where('flag','Company');
        });
        static::creating(function ($query) {
            $query->flag = 'Company';
        });
    }

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getShowResource(){
        return ShowPayer::class;
    }

    public function getViewResource(){
        return ViewPayer::class;
    }
}
