<?php

namespace App\Http\Requests\ClientRequests\InvoiceType;

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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

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
