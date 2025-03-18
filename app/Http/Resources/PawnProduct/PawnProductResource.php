<?php

namespace App\Http\Resources\PawnProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class PawnProductResource extends JsonResource
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
