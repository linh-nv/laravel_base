<?php

namespace App\Http\Requests\ClientRequests\Invoice;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
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
            'name' => 'bail|required|min:2|max:200',
            'invoice_type_id' => 'bail|required|exists:invoice_types,id',
            'user_id' => 'bail|required|exists:users,id',
            'amount' => 'bail|required|numeric|min:10000',
            'date' => 'bail|required',
            'description' => 'bail|nullable',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên hóa đơn']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên hóa đơn']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên hóa đơn']),

            'invoice_type_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại hóa đơn"]),
            'invoice_type_id.exists' => __(':attribute không hợp lệ', ['attribute' => 'Loại hóa đơn']),

            'user_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "người dùng"]),
            'user_id.exists' => __("Người dùng không hợp lệ"),

            'amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'amount.numeric' => __(':attribute không hợp lệ', ['attribute' => 'Số tiền']),
            'amount.min' => __(':attribute phải lớn hơn 10,000 vnđ', ['attribute' => 'Số tiền']),

            'date.required' => __('Vui lòng chọn :attribute', ['attribute' => 'ngày'])

        ];

    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
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
