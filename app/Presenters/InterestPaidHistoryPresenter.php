<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class InterestPaidHistoryPresenter extends Presenter
{
    use ConfigTrait;

    public function presentRowId()
    {
        return "js_capital_record_{$this->object->id}";
    }

    public function presentInterestAmountText()
    {
        return number_format($this->object->interest_amount);
    }
    public function presentInterestPayDateText()
    {
        return date('d/m/Y',strtotime($this->object->interest_pay_date));
    }
}
