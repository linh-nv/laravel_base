<?php

namespace App\Repositories\PawnProduct;

use App\Repositories\Base\RepositoryEloquent;

class PawnProductRepositoryEloquent extends RepositoryEloquent implements PawnProductRepository
{
    public function getModel()
    {
        return \App\Models\PawnProduct::class;
    }


    public function handleFilter($select, $shareholderId = null, $isIn = null, $timeFrom = null, $timeTo = null, $keyword = null)
    {
        return $this->makeSimpleQuery($select)->when($shareholderId != null, function ($query) use ($shareholderId) {
            $query->where(function ($q) use ($shareholderId) {
                return $q->whereShareholderId($shareholderId);
            });
        })->when($isIn != null, function ($query) use ($isIn) {
            $query->where(function ($q) use ($isIn) {
                return $q->whereIsIn($isIn);
            });
        })->when($timeFrom != null, function ($query) use ($timeFrom) {
            $timeFrom = $this->parseDate($timeFrom, 'H:i:s d-m-Y', 'Y-m-d H:i:s');
            return $query->where('date', '>=', $timeFrom);
        })->when($timeTo != null, function ($query) use ($timeTo) {

            $timeTo = $this->parseDate($timeTo, 'H:i:s d-m-Y', 'Y-m-d H:i:s');
            return $query->where('date', '<=', $timeTo);
        })->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('description', 'like', "%{$keyword}%");
            });
        });
    }
}
