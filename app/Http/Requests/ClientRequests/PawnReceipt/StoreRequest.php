<?php

namespace App\Http\Requests\ClientRequests\PawnReceipt;

use App\Rules\CheckEnoughFund;
use App\Rules\ValidDateFormat;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    use ConfigTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $activeCategoryId = $this->findStatusBySlug('active', 'category')['id'];
        return [
            'name' => 'bail|required|min:2|max:200',
            'address' => 'bail|nullable',
            'identify_number' => "bail|nullable|numeric",
            'identify_date' => "bail|nullable|date_format:d/m/Y",
            'identify_region' => "bail|nullable",
            'category_id' => "bail|required|exists:categories,id,status_id,$activeCategoryId,deleted_at,NULL",
            'product_name' => "bail|required",
            'attached_products' => "bail|nullable",
            'attached_products.*.name' => "bail|required",
            'attached_products.*.description' => "bail|nullable",
            'origin_amount' => ["bail","required","numeric","min:10000",new CheckEnoughFund],
            'interest_percent' => "bail|required|numeric|min:1",
            'interest_amount' => "bail|required|numeric|min:10000",
            'pawn_date' => ["bail", "required", new ValidDateFormat()],
            'payment_day' => "bail|required|numeric|min:1",
            'liquidated_day' => "bail|required|numeric|min:1",
            'note' => 'bail|nullable|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

            'identify_number.number' => __(":attribute không hợp lệ", ['attribute' => "Số CMND"]),

            'identify_date.date_format' => __(":attribute không hợp lệ", ['attribute' => "Ngày cấp"]),

            'category_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại sản phẩm"]),
            'category_id.exists' => __("Loại sản phẩm không hợp lệ"),

            'product_name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên mặt hàng']),

            'attached_products.*.name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên mặt hàng']),


            'origin_amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'origin_amount.numeric' => __(":attribute không hợp lệ", ['attribute' => "Số tiền"]),
            'origin_amount.min' => __(":attribute không được bé hơn 10,000đ", ['attribute' => "Số tiền"]),

            'interest_percent.required' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),
            'interest_percent.numeric' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),
            'interest_percent.min' => __(":attribute không được bé hơn 1%", ['attribute' => 'lãi suất']),

            'interest_amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),
            'interest_amount.numeric' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),
            'interest_amount.min' => __(":attribute không được bé hơn 10,000đ", ['attribute' => 'lãi suất']),

            'pawn_date.required' => __('Vui lòng nhập :attribute', ['attribute' => 'ngày cho vay']),

            'payment_day.required' => __('Vui lòng nhập :attribute', ['attribute' => 'hạn trả lãi']),
            'payment_day.numeric' => __(":attribute không hợp lệ", ['attribute' => "Hạn trả lãi"]),
            'payment_day.min' => __(":attribute không hợp lệ", ['attribute' => "Hạn trả lãi"]),

            'liquidated_day.required' => __('Vui lòng nhập :attribute', ['attribute' => 'ngày thanh lý']),
            'liquidated_day.numeric' => __(":attribute không hợp lệ", ['attribute' => "Ngày thanh lý"]),
            'liquidated_day.min' => __(":attribute không hợp lệ", ['attribute' => "Ngày thanh lý"]),

            'note.max' => __(':attribute không hợp lệ.', ['attribute' => 'Ghi chú']),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
