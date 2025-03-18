<?php

namespace App\Http\Resources\Shareholder;

use Illuminate\Http\Resources\Json\JsonResource;

class ShareholderResource extends JsonResource
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
