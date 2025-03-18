<?php

namespace App\Http\Requests\ClientRequests\User;

use App\Rules\CheckCaptchaRule;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateStatusUserRequest extends FormRequest
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
            'status' => 'bail|required|in:'.implode(',', $this->getValidValues(config('status.user'))),

        ];
    }

    public function messages()
    {
        return [
            'status.required' => __("Trạng thái không hợp lệ"),
            'status.in' => __("Trạng thái không hợp lệ"),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
            throw new HttpResponseException(response()->json([
                'message' => $validator->errors()->first(),
            ], JsonResponse::HTTP_BAD_REQUEST));
    }
}
