<?php

namespace App\Repositories\CapitalHistory;

interface CapitalHistoryRepository
{
    public function handleFilter($select, $shareholderId = null, $isIn = null, $timeFrom = null, $timeTo = null, $keyword = null);
}

?>
