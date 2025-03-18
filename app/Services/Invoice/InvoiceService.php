<?php


namespace App\Services\Invoice;


interface InvoiceService
{
    public function store($invoice);
    public function update($id,$newInvoiceInfo);
    public function delete($id);
}
