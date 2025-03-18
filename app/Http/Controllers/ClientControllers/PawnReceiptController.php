<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\PawnReceipt\FilterPawnReceiptRequest;
use App\Http\Requests\ClientRequests\PawnReceipt\PayInterestRequest;
use App\Http\Requests\ClientRequests\PawnReceipt\PayLoanRequest;
use App\Http\Requests\ClientRequests\PawnReceipt\StoreRequest;
use App\Repositories\PawnReceipt\PawnReceiptRepository;
use App\Services\PawnReceipt\PawnReceiptService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Response;
use Throwable;

class PawnReceiptController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $pawnReceiptRepository, $pawnReceiptService;

    public function __construct(PawnReceiptRepository $pawnReceiptRepository, PawnReceiptService $pawnReceiptService)
    {
        $this->pawnReceiptRepository = $pawnReceiptRepository;
        $this->pawnReceiptService = $pawnReceiptService;

    }

    /**
     * Display a listing of the resource.
     *
     * @param FilterPawnReceiptRequest $request
     * @return Response
     * @throws Throwable
     */
    public function index(FilterPawnReceiptRequest $request)
    {   $month = $request->get('month',date('m'));
        $pawnReceipts = $this->pawnReceiptRepository->handleFilter('*',$month, $request->search_key, $request->status_id)->latest('id')->get();
        //$pawnReceipts = $this->handlePaginate($pawnReceipts, route('clients.pawn-receipts.index'), $request->only('search_key', 'status_id'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.pawn-receipt.index.table', compact('pawnReceipts'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.pawn-receipt.index", compact('pawnReceipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.pawn-receipt.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->pawnReceiptService->store($request->only('name', 'phone', 'address', 'identify_number', 'identify_date', 'identify_region'), $request->only('name', 'phone', 'address', 'identify_number', 'identify_date', 'identify_region', 'attached_products', 'origin_amount', 'interest_percent', 'interest_amount', 'pawn_date', 'payment_day', 'liquidated_day', 'note'), $request->only('category_id', 'product_name', 'product_description'), \Auth::user()->id);
        if ($created) {
            $detailUrl = route('clients.pawn-receipts.show', ['pawn_receipt' => $created->id]);
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'Phiếu cầm đồ']), ['redirect' => $detailUrl]]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'Phiếu cầm đồ'])]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $pawnReceipt = $this->pawnReceiptRepository->findOrFail($id);
        return view('client.user.pawn-receipt.show', compact('pawnReceipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $pawnReceipt = $this->pawnReceiptRepository->findOrFail($id);
        return view('client.user.pawn-receipt.edit', compact('pawnReceipt'));
    }

    public function update(StoreRequest $request, $id)
    {
        $pawnReceipt = $this->pawnReceiptService->update($id, $request->only('name', 'phone', 'email'));
        if ($pawnReceipt) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin Phiếu cầm đồ'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin Phiếu cầm đồ'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->pawnReceiptService->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'Phiếu cầm đồ'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'Phiếu cầm đồ'])]));
    }

    public function payInterest($id)
    {
        $pawnReceipt = $this->pawnReceiptRepository->findOrFail($id);
        return view('client.user.pawn-receipt.pay-interest', compact('pawnReceipt'));
    }

    public function payInterestHandle($id, PayInterestRequest $request)
    {
        $interestPaid = $this->pawnReceiptService->payInterest($id,$request->only('interest_amount','payment_round','interest_pay_date'),\Auth::user()->id);
        if ($interestPaid) {
            return response()->json($this->handleExecuteActionResponse(...[true, __(':action thành công!', ['action' => 'Đóng lãi'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __(':action thất bại!', ['action' => 'Đóng lãi'])]));
    }
    public function payLoan($id)
    {
        $pawnReceipt = $this->pawnReceiptRepository->findActivePawnReceipt($id);
        return view('client.user.pawn-receipt.pay-loan', compact('pawnReceipt'));
    }

    public function payLoanHandle($id, PayLoanRequest $request)
    {
        $loanPaid = $this->pawnReceiptService->payLoan($id,$request->only('loan','loan_payment_date'),\Auth::user()->id);
        if ($loanPaid) {
            return response()->json($this->handleExecuteActionResponse(...[true, __(':action thành công!', ['action' => 'Đóng lãi'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __(':action thất bại!', ['action' => 'Đóng lãi'])]));
    }
}
