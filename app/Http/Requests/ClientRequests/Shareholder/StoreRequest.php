<?php

namespace App\Http\Requests\ClientRequests\Shareholder;

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
            'phone' => "bail|required|unique:shareholders,phone,{$this->route('shareholder', 'NULL')},id,deleted_at,NULL",
            'email' => "bail|nullable|email:rfc,dns|unique:shareholders,email,{$this->route('shareholder', 'NULL')},id,deleted_at,NULL",
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

            'email.required' => __('Vui lòng nhập :attribute', ['attribute' => 'Email']),
            'email.unique' => __(':attribute đã tồn tại.', ['attribute' => 'Email']),

            'password.required' => __('Vui lòng nhập :attribute', ['attribute' => 'mật khẩu']),
        ];

    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('password', 'required', function () {
            return $this->route('shareholder') == null;
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
