<?php


namespace App\Services\PawnProduct;


interface PawnProductService
{
    public function store($customerInfo,$pawnProductInfo,$pawnProducts);
}
