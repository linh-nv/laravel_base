<?php


namespace App\Services\Product;


use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductServiceImp implements ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    public function store($product)
    {

        DB::beginTransaction();
        try {
            $product = $this->productRepository->create($product);
            DB::commit();
            return $product;
        } catch (\Exception $exception) {
            Log::error("Create new product has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newProductInfo)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findOrFail($id);
            $product->update($newProductInfo);
            DB::commit();
            return $product;
        } catch (\Exception $exception) {
            Log::error("Update product has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findOrFail($id);
            $product->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete product has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
