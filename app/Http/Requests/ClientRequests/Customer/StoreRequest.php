<?php

namespace App\Http\Requests\ClientRequests\Customer;

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
            'phone' => "bail|required|unique:customers,phone,{$this->route('customer', 'NULL')},id,deleted_at,NULL",
            'address' => 'bail|required',
            'identify_number' => "bail|required|unique:customers,identify_number,{$this->route('customer', 'NULL')},id,deleted_at,NULL"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

            'phone.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số điện thoại']),
            'phone.unique' => __(':attribute đã tồn tại', ['attribute' => 'Số điện thoại']),

            'address.required' => __('Vui lòng nhập :attribute', ['attribute' => 'địa chỉ']),

            'identify_number.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số CMND/CCCD']),
            'identify_number.unique' => __(':attribute đã tồn tại', ['attribute' => 'Số CMND/CCCD']),


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
