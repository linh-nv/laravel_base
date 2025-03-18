<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class CustomerPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.customers.edit', ['customer' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_customers', 'action' => route('clients.customers.destroy', ['customer' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentTabText()
    {
        return number_format($this->object->tab);
    }

    public function presentTipText()
    {
        return number_format($this->object->tip);
    }

    public function presentRowId()
    {
        return "js_customer_record_{$this->object->id}";
    }

}
