<?php

namespace App\Repositories\PawnReceipt;

interface PawnReceiptRepository
{
    public function handleFilter($select, $month, $keyword = null, $statusId = null);

    public function findActivePawnReceipt($id, $select = ['*']);

    public function filterInterestIsDue($date);//date format Y-m-d

    public function filterInterestOverDue($date);//date format Y-m-d

    public function filterLiquidationIsDue($date);//date format Y-m-d
}

?>
