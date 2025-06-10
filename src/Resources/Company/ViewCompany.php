<?php

namespace Hanafalah\ModulePayer\Resources\Company;

use Hanafalah\ModuleOrganization\Resources\Organization\ViewOrganization;

class ViewCompany extends ViewOrganization
{
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [];
    $arr = $this->mergeArray(parent::toArray($request), $arr);
    return $arr;
  }
}
