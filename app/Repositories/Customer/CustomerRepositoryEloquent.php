<?php

namespace App\Repositories\Customer;

use App\Repositories\Base\RepositoryEloquent;

class CustomerRepositoryEloquent extends RepositoryEloquent implements CustomerRepository
{
    public function getModel()
    {
        return \App\Models\Customer::class;
    }

    public function handleFilter($select, $keyword = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('name', 'like', "%{$keyword}%")->orWhere('phone', 'like', "%{$keyword}%")->orWhere('address', 'like', "%{$keyword}%")->orWhere('identify_number', 'like', "%{$keyword}%");
            });
        });
    }

}
