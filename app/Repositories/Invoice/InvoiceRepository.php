<?php

namespace App\Repositories\Invoice;

interface InvoiceRepository
{
    public function handleFilter($select, $keyword = null, $invoiceTypeId = null, $userId = null, $timeFrom = null, $timeTo = null);
    public function getActiveInvoices();
}

?>
