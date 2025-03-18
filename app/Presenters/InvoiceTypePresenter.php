<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class InvoiceTypePresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        if ($this->object->is_system) return;
        $editUrl = route('clients.invoice-types.edit', ['invoice_type' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_invoice_types', 'action' => route('clients.invoice-types.destroy', ['invoice_type' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }


    public function presentRowId()
    {
        return "js_invoice_type_record_{$this->object->id}";
    }

}
