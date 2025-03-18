<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class CapitalHistoryPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.capitals.edit', ['capital' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_capitals', 'action' => route('clients.capitals.destroy', ['capital' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentRowId()
    {
        return "js_capital_record_{$this->object->id}";
    }

    public function presentShareHolderName()
    {
        return $this->object->shareholder->name;
    }

    public function presentShareHolderPhone()
    {
        return $this->object->shareholder->phone;
    }

    public function presentAmountText()
    {
        return number_format($this->object->amount) . " vnđ";
    }
    public function presentLastAmountText()
    {
        return number_format($this->object->last_amount) . " vnđ";
    }
    public function presentInOutText()
    {
        return $this->findTypeById($this->object->is_in,'capital')['name'];
    }
    public function presentDateText()
    {
        return date('H:i d-m-Y',strtotime($this->object->date));
    }
}
