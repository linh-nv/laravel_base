<?php


namespace App\Services\InvoiceType;


use App\Repositories\InvoiceType\InvoiceTypeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceTypeServiceImp implements InvoiceTypeService
{
    protected $invoiceTypeRepository;

    public function __construct(InvoiceTypeRepository $invoiceTypeRepository)
    {
        $this->invoiceTypeRepository = $invoiceTypeRepository;

    }

    public function store($invoiceType)
    {

        DB::beginTransaction();
        try {
            $category = $this->invoiceTypeRepository->create($invoiceType);
            DB::commit();
            return $invoiceType;
        } catch (\Exception $exception) {
            Log::error("Create new invoiceType has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newInvoiceTypeInfo)
    {
        DB::beginTransaction();
        try {
            $invoiceType = $this->invoiceTypeRepository->findOrFail($id);
            $invoiceType->update($newInvoiceTypeInfo);
            DB::commit();
            return $invoiceType;
        } catch (\Exception $exception) {
            Log::error("Update invoice type has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $invoiceType = $this->invoiceTypeRepository->findOrFail($id);
            $invoiceType->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete invoice type has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
