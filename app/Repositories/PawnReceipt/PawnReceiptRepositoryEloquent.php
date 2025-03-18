<?php

namespace App\Repositories\PawnReceipt;

use App\Repositories\Base\RepositoryEloquent;
use App\TraitHelpers\ConfigTrait;

class PawnReceiptRepositoryEloquent extends RepositoryEloquent implements PawnReceiptRepository
{
    use ConfigTrait;

    public function getModel()
    {
        return \App\Models\PawnReceipt::class;
    }

    public function handleFilter($select, $month, $keyword = null, $statusId = null)
    {
        return $this->makeSimpleQuery($select)->when($statusId !== null, function ($query) use ($statusId) {
            $query->where(function ($q) use ($statusId) {
                return $q->whereStatusId($statusId);
            });
        })->when($keyword != null, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                return $q->where('description', 'like', "%{$keyword}%");
            });
        })->when($month != null, function ($query) use ($month) {
            $query->where(function ($q) use ($month) {
                return $q->whereMonth('pawn_date', $month)->whereYear('pawn_date', date('Y'));
            });
        });
    }

    public function findActivePawnReceipt($id, $select = ["*"])
    {
        $activePawnReceiptId = $this->findStatusBySlug('active', 'category')['id'];
        return $this->makeSimpleQuery($select)->whereStatusId($activePawnReceiptId)->whereId($id)->firstOrFail();
    }


    public function filterInterestIsDue($date)
    {
        $activeStatusId = $this->findStatusBySlug('active', 'pawn_receipt')['id'];
        return $this->_model->where('interest_payment_date','<=',$date)->whereStatusId($activeStatusId);
    }

    public function filterInterestOverDue($date)
    {
        return $this->_model->where('interest_payment_date','<',$date);
    }

    public function filterLiquidationIsDue($date)
    {
        return $this->_model->where('liquidation_date','<=',$date);
    }
}
