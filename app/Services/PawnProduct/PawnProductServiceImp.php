<?php


namespace App\Services\PawnProduct;


use App\Repositories\PawnProduct\PawnProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PawnProductServiceImp implements PawnProductService
{
    protected $customerRepository;

    public function __construct(PawnProductRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;

    }

    public function store($customerInfo, $pawnProductInfo, $pawnProducts)
    {

        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->firstOrCreate($customer);
            DB::commit();
            return $customer;
        } catch
        (\Exception $exception) {
            Log::error("Create new customer has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
