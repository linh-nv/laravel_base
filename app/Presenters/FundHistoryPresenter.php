<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Carbon\Carbon;
use Robbo\Presenter\Presenter;


class FundHistoryPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.fund-histories.edit', ['fund_history' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_fund_histories', 'action' => route('clients.fund-histories.destroy', ['fund_history' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentRowId()
    {
        return "js_fund_history_record_{$this->object->id}";
    }

    public function presentUserName()
    {
        return $this->user->name ?? 'Unknown';
    }

    public function presentInvoiceTypeName()
    {
        return $this->invoiceType->name ?? 'Unknown';
    }

    public function presentDateText()
    {
        return str_replace('00:00','__:__',date('H:i d/m/Y', strtotime($this->object->date)));
    }

    public function presentAmountText()
    {
        return number_format($this->object->amount);
    }

    public function presentLastAmountText()
    {
        return number_format($this->object->last_amount);
    }

}
