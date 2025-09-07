<?php

namespace Hanafalah\ModulePayer\Resources\Company;

use Hanafalah\ModuleOrganization\Resources\Organization\ShowOrganization as OrganizationShowOrganization;

class ShowCompany extends ViewCompany
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $resquest
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr   = [
      'user_wallet' => $this->relationValidation('userWallet',function(){
          return $this->userWallet->toShowApi();
      })
    ];
    $show  = $this->resolveNow(new OrganizationShowOrganization($this));
    $arr   = $this->mergeArray(parent::toArray($request), $show, $arr);
    return $arr;
  }
}
