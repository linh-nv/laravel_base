<?php

namespace App\Http\Requests;

use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\RequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    use RequestTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function messages()
    {
        return [
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        if ($this->isJsonRequest($this)) {
            throw new HttpResponseException(response()->json([
                'message' => $errors->first(),
                'errors' => $errors,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
