<?php

namespace App\Http\Requests\ClientRequests\Category;

use App\Rules\ValidDatetimeFormat;
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
            'code' => 'bail|required|min:2|max:200|regex:/^[A-Z]+$/',
            'name' => 'bail|required|min:2|max:200',
            'recommend_amount' => 'bail|required|numeric',
            'payment_day' => 'bail|required|numeric',
            'liquided_day' => 'bail|required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'code.required' => __('Vui lòng nhập :attribute', ['attribute' => 'mã']),
            'code.min' => __(':attribute không hợp lệ.', ['attribute' => 'Mã']),
            'code.max' => __(':attribute không hợp lệ.', ['attribute' => 'Mã']),
            'code.regex' => __(':attribute không hợp lệ.', ['attribute' => 'Mã']),

            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

            'recommend_amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),
            'recommend_amount.numeric' => __(':attribute không hợp lệ', ['attribute' => 'Lãi suất']),

            'payment_day.required' => __('Vui lòng nhập :attribute', ['attribute' => 'kỳ lãi']),
            'payment_day.numeric' => __(':attribute không hợp lệ', ['attribute' => 'Kỳ lãi']),

            'liquided_day.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số ngày thanh lý']),
            'liquided_day.numeric' => __(':attribute không hợp lệ', ['attribute' => 'Số ngày thanh lý'])

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
