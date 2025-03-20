<?php

namespace Hanafalah\ModulePayer\Resources\Payer;

use Hanafalah\ModuleOrganization\Resources\ShowOrganization;

class ShowPayer extends ShowOrganization
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
    $view  = $this->resolveNow(new ViewPayer($this));
    $arr   = $this->mergeArray(parent::toArray($request), $view, $arr);
    return $arr;
  }
}
