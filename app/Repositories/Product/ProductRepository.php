<?php

namespace App\Repositories\Product;

interface ProductRepository
{
    public function handleFilter($select, $keyword = null, $categoryId = null);
}

?>
