<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\CapitalHistory\FilterCapitalHistoryRequest;
use App\Http\Requests\ClientRequests\CapitalHistory\StoreRequest;
use App\Repositories\CapitalHistory\CapitalHistoryRepository;
use App\Services\CapitalHistory\CapitalHistoryService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Response;

class CapitalHistoryController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $capitalHistoryRepository, $capitalHistoryService;

    public function __construct(CapitalHistoryRepository $capitalHistoryRepository, CapitalHistoryService $capitalHistoryService)
    {
        $this->capitalHistoryRepository = $capitalHistoryRepository;
        $this->capitalHistoryService = $capitalHistoryService;

        $this->middleware(['role:root']);

    }

    /**
     * Display a listing of the resource.
     *
     * @param FilterCapitalHistoryRequest $request
     * @return Response
     * @throws \Throwable
     */
    public function index(FilterCapitalHistoryRequest $request)
    {
        $capitalHistories = $this->capitalHistoryRepository->handleFilter('*', $request->shareholder_id, $request->in_out, $request->time_from, $request->time_to, $request->search_key)->latest('date');
        $capitalHistories = $this->handlePaginate($capitalHistories, route('clients.capitals.index'), $request->only('shareholder_id', 'is_in', 'time_from', 'time_to', 'search_key'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.capital.index.table', compact('capitalHistories'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.capital.index", compact('capitalHistories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.capital.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->capitalHistoryService->store($request->only('shareholder_id', 'amount', 'last_amount', 'description', 'is_in'),\Auth::user()->id);
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'lịch sử thay đổi cổ phần'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'lịch sử thay đổi cổ phần'])]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $capital = $this->capitalRepository->findOrFail($id);
        return view('client.user.capital.edit', compact('capital'));
    }

    public function update(StoreRequest $request, $id)
    {
        $capital = $this->capitalRepository->update($id, $request->only('shareholder_id', 'amount', 'last_amount', 'description', 'is_in'));
        if ($capital) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin cổ phẩn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin cổ phẩn'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->capitalRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'cổ phẩn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'cổ phẩn'])]));
    }
}
