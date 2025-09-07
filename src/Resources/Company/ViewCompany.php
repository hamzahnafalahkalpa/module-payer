<?php

namespace Hanafalah\ModulePayer\Resources\Company;

use Hanafalah\ModuleOrganization\Resources\Organization\ViewOrganization;

class ViewCompany extends ViewOrganization
{
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'user_wallet' => $this->relationValidation('userWallet',function(){
          return $this->userWallet->toViewApi()->resolve();
      })
    ];
    $arr = $this->mergeArray(parent::toArray($request), $arr);
    return $arr;
  }
}
