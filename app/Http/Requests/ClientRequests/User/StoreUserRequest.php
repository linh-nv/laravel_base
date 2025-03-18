<?php

namespace App\Http\Requests\ClientRequests\User;

use App\Http\Requests\BaseFormRequest;
use App\TraitHelpers\ConfigTrait;

class StoreUserRequest extends BaseFormRequest
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
            'name' => 'bail|required|min:2|max:200',
            'phone' => "bail|required|unique:users,phone,{$this->route('user', 'NULL')},id,deleted_at,NULL",
            'email' => "bail|nullable|email:rfc,dns|unique:users,email,{$this->route('user', 'NULL')},id,deleted_at,NULL",
            'role' => 'bail|required|exists:roles,name',
            'status_id' => 'bail|required|in:' . implode(',', $this->getValidValues(config('status.user'))),
        ];
    }

    public function messages()
    {
        $messages = [
            'name.required' => __('Vui lòng nhập :attribute', ['attribute' => 'tên']),
            'name.min' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),
            'name.max' => __(':attribute không hợp lệ.', ['attribute' => 'Tên']),

            'phone.required' => __('Vui lòng nhập :attribute', ['attribute' => 'số điện thoại']),
            'phone.unique' => __(':attribute đã tồn tại', ['attribute' => 'Số điện thoại']),

            'email.required' => __('Vui lòng nhập :attribute', ['attribute' => 'Email']),
            'email.unique' => __(':attribute đã tồn tại.', ['attribute' => 'Email']),

            'password.required' => __('Vui lòng nhập :attribute', ['attribute' => 'mật khẩu']),

            'role.required' => __('Vui lòng chọn :attribute', ['attribute' => "loại người dùng"]),
            'role.exists' => __("Loại người dùng không hợp lệ"),
            'status_id.required' =>__('Vui lòng chọn :attribute', ['attribute' => "trạng thái"]),
            'status_id.in' => __("Trạng thái không hợp lệ"),
        ];

        $parentMessages = parent::messages();
        return array_merge($parentMessages, $messages);

    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('password', 'required', function () {
            return $this->route('user') == null;
        });
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
