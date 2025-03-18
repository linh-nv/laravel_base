<?php

namespace App\Repositories\FundHistory;

use App\Repositories\Base\RepositoryEloquent;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;

class FundHistoryRepositoryEloquent extends RepositoryEloquent implements FundHistoryRepository
{
    use DateTrait, ConfigTrait;

    public function getModel()
    {
        return \App\Models\FundHistory::class;
    }

    public function handleFilter($select, $keyword = null, $invoiceTypeId = null, $userId = null, $timeFrom = null, $timeTo = null)
    {
        return $this->makeSimpleQuery($select)->when($keyword != null, function ($query) use ($keyword) {
            $query->where('description', 'like', "%{$keyword}%");
        })->when($invoiceTypeId != null, function ($query) use ($invoiceTypeId) {
            return $query->whereInvoiceTypeId($invoiceTypeId);
        })->when($userId != null, function ($query) use ($userId) {
            return $query->whereUserId($userId);
        })->when($timeFrom != null, function ($query) use ($timeFrom) {
            $timeFrom = $this->parseDate($timeFrom, 'H:i:s d-m-Y', 'Y-m-d H:i:s');
            return $query->where('date', '>=', $timeFrom);
        })->when($timeTo != null, function ($query) use ($timeTo) {
            $timeTo = $this->parseDate($timeTo, 'H:i:s d-m-Y', 'Y-m-d H:i:s');
            return $query->where('date', '<=', $timeTo);
        });

    }

}
