<?php

namespace Gii\ModulePayer\Resources\Company;

use Gii\ModuleOrganization\Resources\ShowOrganization;

class ShowCompany extends ShowOrganization
{
    public function toArray(\Illuminate\Http\Request $request) : array{
      $arr  = [];
      $view = $this->resolveNow(new ViewCompany($this));
      $arr  = $this->mergeArray(parent::toArray($request),$view,$arr);
      return $arr;
  }
}