<?php

namespace App\Repositories\Category;

interface CategoryRepository
{
    public function handleFilter($select, $keyword = null, $status_id = null);
    public function getActiveCategories();
}

?>
