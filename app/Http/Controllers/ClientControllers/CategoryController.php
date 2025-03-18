<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\Category\FilterCategoryRequest;
use App\Http\Requests\ClientRequests\Category\StoreRequest;
use App\Http\Requests\ClientRequests\User\UpdateStatusUserRequest;
use App\Repositories\Category\CategoryRepository;
use App\Services\Category\CategoryService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $categoryRepository, $categoryService;

    public function __construct(CategoryRepository $categoryRepository, CategoryService $categoryService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterCategoryRequest $request)
    {
        $categories = $this->categoryRepository->handleFilter('*', $request->search_key, $request->status_id)->latest('id');
        $categories = $this->handlePaginate($categories, route('clients.categories.index'), $request->only('search_key', 'status_id'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.category.index.table', compact('categories'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.category.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->categoryService->store($request->only('code', 'name', 'recommend_amount', 'payment_day', 'liquided_day', 'description'));
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'loại sản phẩm'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'loại sản phẩm'])]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        return view('client.user.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $category = $this->categoryRepository->update($id, $request->only('code', 'name', 'recommend_amount', 'payment_day', 'liquided_day', 'description'));
        if ($category) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin loại sản phẩm'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin loại sản phẩm'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->categoryRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'loại sản phẩm'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'loại sản phẩm'])]));
    }

    public function updateStatus(UpdateStatusUserRequest $request, $categoryId)
    {
        $updated = $this->categoryRepository->update($categoryId, ['status_id' => $request->status]);
        if ($updated) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Thay đổi :action thành công!', ['action' => 'trạng thái'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Thay đổi :action thất bại!', ['action' => 'trạng thái'])]));
    }
}
