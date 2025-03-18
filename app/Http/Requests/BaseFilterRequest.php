<?php

namespace App\Http\Requests;

use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\RequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseFilterRequest extends BaseFormRequest
{
    use RequestTrait;

    public function rules()
    {
        return [
            'limit' => 'bail|nullable|integer',
            'page' => 'bail|nullable|integer',
        ];
    }
}
