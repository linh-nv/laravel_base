<?php


namespace App\Services\Shareholder;


interface ShareholderService
{
    public function store($shareholder);
    public function update($id,$newShareholderInfo);
    public function delete($id);
}
