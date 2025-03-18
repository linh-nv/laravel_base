<?php


namespace App\Services\Customer;


interface CustomerService
{
    public function store($customer);
    public function update($id,$newCustomerInfo);
    public function delete($id);
}
