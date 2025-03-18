<?php

namespace App\Repositories\InvoiceType;

interface InvoiceTypeRepository
{
    public function handleFilter($select, $keyword = null);
}

?>
