<?php


namespace App\Services\InvoiceType;


interface InvoiceTypeService
{
    public function store($category);
    public function update($id,$newInvoiceTypeInfo);
    public function delete($id);
}
