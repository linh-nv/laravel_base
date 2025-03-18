<?php

namespace App\Http\Requests\ClientRequests\FundHistory;

use App\Rules\ValidDatetimeFormat;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilterFundHistoryRequest extends FormRequest
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
        $activeUserId = $this->findStatusBySlug('active', 'user')['id'];
        return [
            'search_key' => 'bail|nullable|max:100',
            'user_id' => "bail|nullable|exists:users,id,status_id,$activeUserId",
            'invoice_type_id' => "bail|nullable|exists:invoice_types,id",

        ];
    }

    public function messages()
    {
        return [
            'search_key.max' => __(':attribute không hợp lệ.', ['attribute' => 'Từ khoá']),
        ];

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
