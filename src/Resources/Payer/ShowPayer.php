<?php

namespace Hanafalah\ModulePayer\Resources\Payer;

use Hanafalah\ModuleOrganization\Resources\Organization\ShowOrganization as OrganizationShowOrganization;

class ShowPayer extends ViewPayer
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $resquest
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr   = [];
    $show  = $this->resolveNow(new OrganizationShowOrganization($this));
    $arr   = $this->mergeArray(parent::toArray($request), $show, $arr);
    return $arr;
  }
}
