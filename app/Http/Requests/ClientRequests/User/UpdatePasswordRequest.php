<?php

namespace App\Http\Requests\ClientRequests\User;

use App\Rules\ValidOldPassword;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdatePasswordRequest extends FormRequest
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
            'new_password' => 'bail|required|min:6|max:16',
            're_new_password' => 'bail|required|min:6|max:16|same:new_password',
        ];
    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('old_password', ['required', new ValidOldPassword], function () {
            return $this->route('id') == null;
        });
        return $validator;
    }
    public function messages()
    {
        return [
            'new_password.required' => __('Vui lòng nhập :attribute',['attribute'=>'mật khẩu mới']),
            'new_password.min' => __(':attribute không được dưới 6 ký tự.',['attribute'=>'Mật khẩu']),
            'new_password.max' => __(':attribute không được quá 16 ký tự.',['attribute'=>'Mật khẩu']),

            're_new_password.required' => __('Vui lòng nhập :attribute',['attribute'=>'lại mật khẩu mới']),
            're_new_password.min' => __(':attribute không được dưới 6 ký tự.',['attribute'=>'Mật khẩu']),
            're_new_password.max' => __(':attribute không được quá 16 ký tự.',['attribute'=>'Mật khẩu']),
            're_new_password.same' => __(':attribute không được quá 16 ký tự.',['attribute'=>'Mật khẩu']),

            'old_password.required' => __('Vui lòng nhập :attribute',['attribute'=>'mật khẩu cũ']),
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
