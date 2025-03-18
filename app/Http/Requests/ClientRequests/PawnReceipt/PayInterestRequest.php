<?php

namespace App\Http\Requests\ClientRequests\PawnReceipt;

use App\Rules\ValidDateFormat;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PayInterestRequest extends FormRequest
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

            'interest_amount' => "bail|required|numeric|min:10000",
            'payment_round' => "bail|required|numeric|min:1",
            'interest_pay_date' => ["bail", "required", new ValidDateFormat()],
        ];
    }

    public function messages()
    {
        return [
            'interest_amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'interest_amount.numeric' => __('Vui lòng nhập :attribute', ['attribute' => 'số tiền']),
            'interest_amount.min' => __(":attribute không được bé hơn 10,000đ", ['attribute' => 'số tiền']),

            'payment_round.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số kỳ lãi']),
            'payment_round.numeric' => __(":attribute không hợp lệ", ['attribute' => "Số kỳ lãi"]),
            'payment_round.min' => __(":attribute không hợp lệ", ['attribute' => "Số kỳ lãi"]),

            'interest_pay_date.required' => __('Vui lòng nhập :attribute', ['attribute' => 'ngày chi trả']),
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
