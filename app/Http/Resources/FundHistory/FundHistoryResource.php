<?php

namespace App\Http\Resources\FundHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class FundHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
