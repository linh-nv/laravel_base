<?php

namespace App\Http\Requests\ClientRequests\Auth;

use App\Rules\CheckCaptchaRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $capchaRule;

    public function __construct(CheckCaptchaRule $capchaRule)
    {
        $this->capchaRule = $capchaRule;
    }

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
            'g_recaptcha' => ['bail', 'required', $this->capchaRule],
            'username' => ['bail', 'required', 'regex:/^([a-zA-Z0-9])+$/'],
            'password' => 'bail|required',

        ];
    }

    public function messages()
    {
        return [
            'g_recaptcha.required' => __('Vui lòng xác nhận bạn không phải là máy.'),
            'username.required' => __('Vui lòng nhập tên đăng nhập.'),
            'username.regex' => __("Tên đăng nhập không hợp lệ."),
            'password.required' => __("Vui lòng nhập mật khẩu."),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
