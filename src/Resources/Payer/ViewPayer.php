<?php

namespace Hanafalah\ModulePayer\Resources\Payer;

use Hanafalah\ModulePayer\Resources\Company\ViewCompany;

class ViewPayer extends ViewCompany
{
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'is_payer_able' => $this->is_payer_able
    ];
    $arr = $this->mergeArray(parent::toArray($request), $arr);
    return $arr;
  }
}
