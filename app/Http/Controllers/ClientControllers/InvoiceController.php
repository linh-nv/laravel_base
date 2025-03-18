<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\Invoice\FilterInvoiceRequest;
use App\Http\Requests\ClientRequests\Invoice\StoreRequest;
use App\Repositories\FundHistory\FundHistoryRepository;
use App\Services\Invoice\InvoiceService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $fundHistoryRepository, $fundHistoryService;

    public function __construct(FundHistoryRepository $fundHistoryRepository, InvoiceService $fundHistoryService)
    {
        $this->fundHistoryRepository = $fundHistoryRepository;
        $this->fundHistoryService = $fundHistoryService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterInvoiceRequest $request)
    {
        $fundHistorys = $this->fundHistoryRepository->handleFilter('*', $request->search_key, $request->fundHistory_type_id, $request->user_id, $request->status_id, $request->time_from, $request->time_to)->with(['user', 'fundHistoryType'])->latest('date');
        $fundHistorys = $this->handlePaginate($fundHistorys, route('clients.fundHistorys.index'), $request->only('search_key', 'fundHistory_type_id', 'user_id', 'status_id', 'time_from', 'time_to'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.fundHistory.index.table', compact('fundHistorys'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.fundHistory.index", compact('fundHistorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.fundHistory.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->fundHistoryService->store($request->only('name', 'fundHistory_type_id', 'user_id', 'amount', 'date', 'description'));
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'hóa đơn'])]));
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
        $fundHistory = $this->fundHistoryRepository->findOrFail($id);
        return view('client.user.fundHistory.edit', compact('fundHistory'));
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
        $fundHistory = $this->fundHistoryService->update($id, $request->only('name', 'fundHistory_type_id', 'user_id', 'amount', 'date', 'description'));
        if ($fundHistory) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin hóa đơn'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->fundHistoryRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'hóa đơn'])]));
    }
}
