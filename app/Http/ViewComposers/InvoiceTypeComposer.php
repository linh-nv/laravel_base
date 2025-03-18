<?php

namespace App\Http\ViewComposers;

use App\Models\InvoiceType;
use App\Repositories\Invoice\InvoiceRepository;
use Robbo\Presenter\View\View;

class InvoiceTypeComposer
{

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function compose(View $view)
    {
        $view->with('invoiceTypes', InvoiceType::all());
    }
}
