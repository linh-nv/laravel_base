<?php

namespace App\Http\Requests\ClientRequests\Product;

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
        $activeCategoryId = $this->findStatusBySlug('active', 'category')['id'];
        return [
            'name' => 'bail|required|min:2|max:200',
            'recommend_amount' => 'bail|required|regex:/^\d+(\.\d{1,2})?$/',
            "category_id' => 'bail|required|exists:categories,id,status_id,{$activeCategoryId},deleted_at,NULL",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

            'recommend_amount.required' => __('Vui lòng nhập :attribute', ['attribute' => 'lãi suất']),

            'category_id.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại sản phẩm"]),
            'category_id.exists' => __("Loại sản phẩm không hợp lệ"),

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
