<?php

namespace App\Repositories\Shareholder;

use App\Repositories\Base\RepositoryEloquent;

class ShareholderRepositoryEloquent extends RepositoryEloquent implements ShareholderRepository
{
    public function getModel()
    {
        return \App\Models\Shareholder::class;
    }

    public function handleFilter($select, $keyword = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('name', 'like', "%{$keyword}%")->orWhere('phone', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%");
            });
        });
    }

}
