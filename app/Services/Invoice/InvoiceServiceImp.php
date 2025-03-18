<?php


namespace App\Services\Invoice;


use App\Repositories\Invoice\InvoiceRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceServiceImp implements InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;

    }

    public function store($invoice)
    {

        DB::beginTransaction();
        try {
            $invoice['date'] = $this->invoiceRepository->formatDate($invoice['date']);
            $invoice = $this->invoiceRepository->create($invoice);
            DB::commit();
            return $invoice;
        } catch (\Exception $exception) {
            Log::error("Create new invoice has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newInvoiceInfo)
    {
        DB::beginTransaction();
        try {
            $invoice = $this->invoiceRepository->findOrFail($id);
            $newInvoiceInfo['date'] = $this->invoiceRepository->formatDate($newInvoiceInfo['date']);
            $invoice->update($newInvoiceInfo);
            DB::commit();
            return $invoice;
        } catch (\Exception $exception) {
            Log::error("Update invoice has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $invoice = $this->invoiceRepository->findOrFail($id);
            $invoice->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete invoice has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
