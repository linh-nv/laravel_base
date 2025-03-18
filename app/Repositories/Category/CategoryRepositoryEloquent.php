<?php

namespace App\Repositories\Category;

use App\Repositories\Base\RepositoryEloquent;
use App\TraitHelpers\ConfigTrait;

class CategoryRepositoryEloquent extends RepositoryEloquent implements CategoryRepository
{
    use ConfigTrait;

    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function handleFilter($select, $keyword = null, $status_id = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('name', 'like', "%{$keyword}%")->orWhere('recommend_amount', 'like', "%{$keyword}%")->orWhere('code', 'like', "%{$keyword}%");
            });
        })->when($status_id != null, function($query) use ($status_id) {
            return $query->whereStatusId($status_id);
        });
    }

    public function getActiveCategories()
    {
        $activeStatus = $this->findStatusBySlug('active', 'category');
        return $this->makeSimpleQuery('*')->whereStatusId($activeStatus['id'])->get();
    }

}
