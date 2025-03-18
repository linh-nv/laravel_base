<?php

namespace App\Repositories\Shareholder;

interface ShareholderRepository
{
    public function handleFilter($select, $keyword = null);
}

?>
