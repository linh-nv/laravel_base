<?php

namespace App\Http\Requests\ClientRequests\CapitalHistory;

use App\Rules\CheckCaptchaRule;
use App\Rules\ValidDatetimeFormat;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilterCapitalHistoryRequest extends FormRequest
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
            'search_key' => 'bail|nullable|max:100',
            'shareholder_id' => 'bail|nullable|numeric|exists:shareholders,id,deleted_at,NULL',
            'time_from' => ['bail', new ValidDatetimeFormat],
            'time_to' => ['bail', new ValidDatetimeFormat],
            'description' => 'bail|nullable',
            'in_out' => 'bail|nullable|in:'.implode(',', $this->getValidValues(config('type.capital'))),
        ];
    }

    public function messages()
    {
        return [
            'search_key.max' => __(':attribute không hợp lệ.', ['attribute' => 'Từ khoá']),

            'shareholder_id.exists' => __(':attribute không tồn tại', ['attribute' => 'Cổ đông']),
            'shareholder_id.numeric' => __(':attribute không tồn tại', ['attribute' => 'Cổ đông']),

            'description.max' => __(':attribute không hợp lệ.', ['attribute' => 'Nội dung']),

            'in_out.required' =>__('Vui lòng chọn :attribute', ['attribute' => "loại"]),
            'in_out.in' => __("Loại không hợp lệ"),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()){
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
