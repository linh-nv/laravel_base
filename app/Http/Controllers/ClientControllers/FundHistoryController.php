<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\FundHistory\FilterFundHistoryRequest;
use App\Http\Requests\ClientRequests\FundHistory\StoreRequest;
use App\Repositories\FundHistory\FundHistoryRepository;
use App\Services\FundHistory\FundHistoryService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;

class FundHistoryController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $fundHistoryRepository, $fundHistoryService;

    public function __construct(FundHistoryRepository $fundHistoryRepository, FundHistoryService $fundHistoryService)
    {
        $this->fundHistoryRepository = $fundHistoryRepository;
        $this->fundHistoryService = $fundHistoryService;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterFundHistoryRequest $request)
    {
        $fundHistories = $this->fundHistoryRepository->handleFilter('*', $request->search_key,  $request->invoice_type_id,null, $request->time_from, $request->time_to)->latest()->with('invoiceType');
        $fundHistories = $this->handlePaginate($fundHistories, route('clients.fund-histories.index'), $request->only('search_key'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.fund-history.index.table', compact('fundHistories'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.fund-history.index", compact('fundHistories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.fund-history.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $date = $this->parseDate($request->date, 'd/m/Y', 'Y-m-d');
        $request->merge(['date'=>$date,'user_id'=>\Auth::user()->id]);
        $created = $this->fundHistoryService->store($request->only( 'amount', 'date', 'description', 'invoice_type_id', 'user_id', 'is_in'));
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'lịch sử thanh toán'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'lịch sử thanh toán'])]));
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
        return view('client.user.fund-history.edit', compact('fundHistory'));
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
        $fundHistory = $this->fundHistoryService->update($id, $request->only('user_id', 'amount', 'last_amount', 'date', 'description', 'invoice_type_id'));
        if ($fundHistory) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin lịch sử thanh toán']), ['data' => view('client.user.fund-history.index.table.row', compact('fundHistory'))->render()]]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin lịch sử thanh toán'])]));
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
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'lịch sử thanh toán'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'lịch sử thanh toán'])]));
    }
}
