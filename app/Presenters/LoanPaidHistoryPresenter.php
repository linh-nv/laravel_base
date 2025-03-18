<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class LoanPaidHistoryPresenter extends Presenter
{
    use ConfigTrait;

    public function presentRowId()
    {
        return "js_loan_paid_record_{$this->object->id}";
    }

    public function presentLoanText()
    {
        return number_format($this->object->loan);
    }
    public function presentLastLoanText()
    {
        return number_format($this->object->last_loan);
    }
    public function presentLoanPaymentDateText()
    {
        return date('d/m/Y',strtotime($this->object->loan_payment_date));
    }
}
