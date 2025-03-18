<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\Shareholder\FilterShareholderRequest;
use App\Http\Requests\ClientRequests\Shareholder\StoreRequest;
use App\Repositories\Shareholder\ShareholderRepository;
use App\Services\Shareholder\ShareholderService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;

class ShareholderController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $shareholderRepository, $shareholderService;

    public function __construct(ShareholderRepository $shareholderRepository, ShareholderService $shareholderService)
    {
        $this->shareholderRepository = $shareholderRepository;
        $this->shareholderService = $shareholderService;

        $this->middleware(['role:root']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterShareholderRequest $request)
    {
        $shareholders = $this->shareholderRepository->handleFilter('*', $request->search_key)->latest('id');
        $shareholders = $this->handlePaginate($shareholders, route('clients.shareholders.index'), $request->only('search_key'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.shareholder.index.table', compact('shareholders'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.shareholder.index", compact('shareholders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.shareholder.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->shareholderService->store($request->only('name', 'phone', 'email', 'password'));
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'cổ đông'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'cổ đông'])]));
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
        $shareholder = $this->shareholderRepository->findOrFail($id);
        return view('client.user.shareholder.edit', compact('shareholder'));
    }

    public function update(StoreRequest $request, $id)
    {
        $shareholder = $this->shareholderService->update($id, $request->only('name', 'phone', 'email'));
        if ($shareholder) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin cổ đông'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin cổ đông'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->shareholderService->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'cổ đông'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'cổ đông'])]));
    }
}
