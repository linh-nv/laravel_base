<?php

namespace App\Http\Requests\ClientRequests\FundHistory;

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
        return [
            'amount' => ["bail","required", "numeric", "min:10000"],
            'invoice_type_id' => "bail|required|exists:invoice_types,id,is_system,0,deleted_at,NULL",
            'date' => ["bail", "required", new ValidDateFormat()],
            'is_in' => 'bail|required|in:0,1',
            'description' => 'bail|nullable|max:500',

        ];
    }

    public function messages()
    {
        return [

            'user_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "người dùng"]),
            'user_id.exists' => __("Người dùng không hợp lệ"),

            'amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'amount.numeric' => __(":attribute không hợp lệ", ['attribute' => "Số tiền"]),
            'amount.min' => __(":attribute không được bé hơn 10,000đ", ['attribute' => "Số tiền"]),

            'invoice_type_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại hóa đơn"]),
            'invoice_type_id.exists' => __("Loại hóa đơn không hợp lệ"),

            'is_in.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại"]),
            'is_in.in' => __(":attribute không hợp lệ", ['attribute' => 'Loại']),

            'date.required' => __('Vui lòng nhập :attribute', ['attribute' => 'ngày thanh toán']),
            'description.max' => __(':attribute không hợp lệ.', ['attribute' => 'Ghi chú']),

        ];

    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('amount', new CheckEnoughFund, function () {
            return $this->is_in == false;
        });
        return $validator;
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
