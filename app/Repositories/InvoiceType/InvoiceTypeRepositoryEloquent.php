<?php

namespace App\Repositories\InvoiceType;

use App\Repositories\Base\RepositoryEloquent;

class InvoiceTypeRepositoryEloquent extends RepositoryEloquent implements InvoiceTypeRepository
{
    public function getModel()
    {
        return \App\Models\InvoiceType::class;
    }

    public function handleFilter($select, $keyword = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('name', 'like', "%{$keyword}%");
            });
        });
    }

}
