<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class InvoicePresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.invoices.edit', ['invoice' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_invoices', 'action' => route('clients.invoices.destroy', ['invoice' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentRowId()
    {
        return "js_invoice_record_{$this->object->id}";
    }

    public function presentInvoiceTypeName()
    {
        return $this->invoiceType->name;
    }

    public function presentUserName()
    {
        return $this->user->name;
    }

    public function presentAmountText()
    {
        return number_format($this->object->amount) . " vnđ";
    }

    public function presentStatusName()
    {
        return $this->object->status()->name;
    }

    public function presentDateText()
    {
        return date('H:i d-m-Y', strtotime($this->object->date));
    }

}
