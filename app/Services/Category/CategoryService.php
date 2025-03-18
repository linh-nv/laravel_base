<?php


namespace App\Services\Category;


interface CategoryService
{
    public function store($category);
    public function update($id,$newCategoryInfo);
    public function delete($id);
}
