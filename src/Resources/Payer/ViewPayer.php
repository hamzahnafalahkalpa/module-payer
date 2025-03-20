<?php

namespace Hanafalah\ModulePayer\Resources\Payer;

use Hanafalah\ModuleOrganization\Resources\ViewOrganization;

class ViewPayer extends ViewOrganization
{
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [];
    $arr = $this->mergeArray(parent::toArray($request), $arr);

    return $arr;
  }
}
