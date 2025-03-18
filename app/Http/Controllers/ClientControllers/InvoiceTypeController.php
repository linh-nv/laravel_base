<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\InvoiceType\FilterInvoiceTypeRequest;
use App\Http\Requests\ClientRequests\InvoiceType\StoreRequest;
use App\Repositories\InvoiceType\InvoiceTypeRepository;
use App\Services\InvoiceType\InvoiceTypeService;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;

class InvoiceTypeController extends Controller
{
    use ResourceHelperTrait, ApiResponseTrait, ConfigTrait, DateTrait;

    private $invoiceTypeRepository, $invoiceTypeService;

    public function __construct(InvoiceTypeRepository $invoiceTypeRepository, InvoiceTypeService $invoiceTypeService)
    {
        $this->invoiceTypeRepository = $invoiceTypeRepository;
        $this->invoiceTypeService = $invoiceTypeService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterInvoiceTypeRequest $request)
    {
        $invoiceTypes = $this->invoiceTypeRepository->handleFilter('*', $request->search_key)->latest('id');
        $invoiceTypes = $this->handlePaginate($invoiceTypes, route('clients.invoice-types.index'), $request->only('search_key'));
        if ($request->ajax()) {
            return $this->handleResourcesResponse(true, ['data' => view(parent::CLIENT_VIEW . 'user.invoice_type.index.table', compact('invoiceTypes'))->render()]);
        }
        return view(parent::CLIENT_VIEW . "user.invoice_type.index", compact('invoiceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::CLIENT_VIEW . "user.invoice_type.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = $this->invoiceTypeService->store($request->only('name'));
        if ($created) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Tạo :module thành công!', ['module' => 'loại hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Tạo :module thất bại!', ['module' => 'loại hóa đơn'])]));
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
        $invoiceType = $this->invoiceTypeRepository->findOrFail($id);
        return view('client.user.invoice_type.edit', compact('invoiceType'));
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
        $invoiceType = $this->invoiceTypeRepository->update($id, $request->only('name'));
        if ($invoiceType) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Sửa :module thành công!', ['module' => 'thông tin loại hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Sửa :module thất bại!', ['module' => 'thông tin loại hóa đơn'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->invoiceTypeRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExecuteActionResponse(...[true, __('Xoá :module thành công!', ['module' => 'loại hóa đơn'])]));
        }
        return response()->json($this->handleExecuteActionResponse(...[false, __('Xoá :module thất bại!', ['module' => 'loại hóa đơn'])]));
    }
}
