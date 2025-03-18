<?php


namespace App\Services\Category;


use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryServiceImp implements CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

    }

    public function store($category)
    {

        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->create($category);
            DB::commit();
            return $category;
        } catch (\Exception $exception) {
            Log::error("Create new category has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $newCategoryInfo)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findOrFail($id);
            $category->update($newCategoryInfo);
            DB::commit();
            return $category;
        } catch (\Exception $exception) {
            Log::error("Update category has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findOrFail($id);
            $category->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error("Delete category has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
