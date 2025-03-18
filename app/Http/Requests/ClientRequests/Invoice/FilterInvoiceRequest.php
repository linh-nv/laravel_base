<?php

namespace App\Http\Requests\ClientRequests\Invoice;

use App\Rules\ValidDatetimeFormat;
use Illuminate\Foundation\Http\FormRequest;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilterInvoiceRequest extends FormRequest
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
            'invoice_type_id' => 'bail|nullable|exists:invoice_types,id',
            'user_id' => 'bail|nullable|exists:users,id',
            'status_id' => 'bail|nullable|in:'.implode(',', $this->getValidValues(config('status.invoice'))),
            'time_from' => ['bail', new ValidDatetimeFormat],
            'time_to' => ['bail', new ValidDatetimeFormat],
            'description' => 'bail|nullable'

        ];
    }

    public function messages()
    {
        return [
            'search_key.max' => __(':attribute không hợp lệ.', ['attribute' => 'Từ khoá']),

            'invoice_type_id.exists' => __("Loại hóa đơn không hợp lệ"),

            'user_id.exists' => __("Người dùng không hợp lệ"),

            'description.max' => __(':attribute không hợp lệ.', ['attribute' => 'Nội dung']),

            'status_id.in' => __("Trạng thái không hợp lệ"),
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
