<?php

namespace App\Http\Requests\ClientRequests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilterProductRequest extends FormRequest
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
        $activeCategory = $this->findStatusBySlug('active', 'category')['id'];
        return [
            'search_key' => 'bail|nullable|max:100',
            'category_id' => 'bail|nullable|exists:categories,id'.$activeCategory.'',
        ];
    }

    public function messages()
    {
        return [
            'search_key.max' => __(':attribute không hợp lệ.', ['attribute' => 'Từ khoá']),

            'category_id.exists' => __("Loại sản phẩm không hợp lệ"),
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
