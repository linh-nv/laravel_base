<?php


namespace App\Services\Customer;


use App\Repositories\Customer\CustomerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerServiceImp implements CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;

    }

    public function store($customer)
    {

        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->create($customer);
            DB::commit();
            return $customer;
        } catch (\Exception $exception) {
            Log::error("Create new customer has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newCustomerInfo)
    {
        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->findOrFail($id);
            $customer->update($newCustomerInfo);
            DB::commit();
            return $customer;
        } catch (\Exception $exception) {
            Log::error("Update customer has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->findOrFail($id);
            $customer->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete customer has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
