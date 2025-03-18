<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class PawnReceiptPresenter extends Presenter
{
    use ConfigTrait;

    /**
     * @var mixed
     */
    public function presentAction()
    {
        $pawnReceiptId = $this->object->id;
        $showUrl = route('clients.pawn-receipts.show', ['pawn_receipt' => $pawnReceiptId]);
        $contentButton = view('client.share.button.show', compact('showUrl'))->render();
        switch ($this->object->status()->slug) {
            case 'active':
            case 'delay':
                $contentButton .= view('client.user.pawn-receipt.button.pay-interest', compact('pawnReceiptId'))->render();
                $contentButton .= view('client.user.pawn-receipt.button.pay-loan', compact('pawnReceiptId'))->render();
                break;
        }
        return $contentButton;
    }

    public function presentRowId()
    {
        return "js_pawn-receipt_record_{$this->object->id}";
    }

    public function presentOriginAmountText()
    {
        return number_format($this->object->origin_amount);
    }
    public function presentLoanPaidText()
    {
        return number_format($this->object->loan_paid);
    }

    public function presentInterestAmountText()
    {
        return number_format($this->object->interest_amount);
    }

    public function presentInterestPaidText()
    {
        return number_format($this->object->interest_paid);
    }
    public function presentRemainLoan()
    {
        $remainLoan = $this->object->origin_amount-$this->object->loan_paid;
        return $remainLoan<0?0:$remainLoan;
    }
    public function presentRemainLoanText()
    {
        return number_format($this->remain_loan);
    }

    public function presentStatusText()
    {
        return $this->object->status()->name;
    }

    public function presentDeadline()
    {
        return date('d/m/Y', strtotime($this->object->interest_payment_date));
    }

    public function presentLiquidatedDate()
    {
        return date('d/m/Y', strtotime($this->object->liquidation_date));
    }

    public function presentProductName()
    {
        return $this->object->pawnProduct->product->name ?? null;
    }
    public function presentBgClass()
    {
        return $this->object->status()->bg_class;
    }
    public function presentCategoryName()
    {
        return $this->object->pawnProduct->product->category->name ?? null;
    }

    public function presentProductInfo()
    {
        return $this->object->pawnProduct->description ?? null;
    }

    public function presentPawnDateText()
    {
        return date('d/m/Y', strtotime($this->object->pawn_date));
    }

}
