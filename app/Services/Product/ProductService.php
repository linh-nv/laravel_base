<?php


namespace App\Services\Product;


interface ProductService
{
    public function store($product);
    public function update($id,$newProductInfo);
    public function delete($id);
}
