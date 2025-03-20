<?php

namespace Gii\ModulePayer\Resources\Payer;

use Gii\ModuleOrganization\Resources\ViewOrganization;

class ViewPayer extends ViewOrganization
{
    public function toArray(\Illuminate\Http\Request $request) : array{
      $arr = [
      ];
      $arr = $this->mergeArray(parent::toArray($request),$arr);
      
      return $arr;
  }
}