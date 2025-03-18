<?php

namespace App\Http\Resources\Statistic;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatisticResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
