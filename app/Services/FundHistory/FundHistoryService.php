<?php


namespace App\Services\FundHistory;


interface FundHistoryService
{
    public function store(array $fundHistory, $modelSlug = null);
}
