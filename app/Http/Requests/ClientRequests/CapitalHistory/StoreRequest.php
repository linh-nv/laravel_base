<?php

namespace App\Http\Requests\ClientRequests\CapitalHistory;

use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
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
            'shareholder_id' => 'bail|required|numeric|exists:shareholders,id,deleted_at,NULL',
            'description' => 'bail|nullable',
            'amount' => "bail|required|numeric|min:10000",
            'is_in' => 'bail|required|in:'.implode(',', $this->getValidValues(config('type.capital'))),
        ];
    }

    public function messages()
    {
        return [

            'shareholder_id.required' => __('Vui lòng chọn :attribute', ['attribute' => 'cổ đông']),
            'shareholder_id.exists' => __(':attribute không tồn tại', ['attribute' => 'Cổ đông']),

            'amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'amount.numeric' => __(':attribute không hợp lệ', ['attribute' => 'Số tiền']),
            'amount.min' => __(':attribute phải lớn hơn 10,000 vnđ', ['attribute' => 'Số tiền']),

            'is_in.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại"]),
            'is_in.in' => __(":attribute không hợp lệ", ['attribute' => 'Loại']),
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
