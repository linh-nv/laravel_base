<?php

namespace App\Repositories\PawnProduct;

interface PawnProductRepository
{
    public function handleFilter($select, $keyword = null, $statusId = null, $timeFrom = null, $timeTo = null);
}

?>
