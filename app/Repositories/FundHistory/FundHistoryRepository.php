<?php

namespace App\Repositories\FundHistory;

interface FundHistoryRepository
{
    public function handleFilter($select, $keyword = null, $invoiceTypeId = null, $userId = null, $timeFrom = null, $timeTo = null);
}

?>
