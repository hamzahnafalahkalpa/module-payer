<?php

namespace Hanafalah\ModulePayer\Resources\Payer;

use Hanafalah\ModulePayer\Resources\Company\ShowCompany;

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
    $show  = $this->resolveNow(new ShowCompany($this));
    $arr   = $this->mergeArray(parent::toArray($request), $show, $arr);
    return $arr;
  }
}
