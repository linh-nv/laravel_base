<?php

namespace App\Repositories\Product;

use App\Repositories\Base\RepositoryEloquent;

class ProductRepositoryEloquent extends RepositoryEloquent implements ProductRepository
{
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function handleFilter($select, $keyword = null, $categoryId = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('name', 'like', "%{$keyword}%");
            });
        })->when($categoryId != null, function ($query) use ($categoryId) {
            return $query->whereCategoryId($categoryId);
        });


    }

}
