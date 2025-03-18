<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class ShareholderPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.shareholders.edit', ['shareholder' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_shareholders', 'action' => route('clients.shareholders.destroy', ['shareholder' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }


    public function presentRowId()
    {
        return "js_shareholder_record_{$this->object->id}";
    }
    public function presentTotalCapitalText()
    {
        return number_format($this->object->total_capital). " vnđ";
    }

}
