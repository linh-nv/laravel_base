<?php

namespace App\Http\Requests\ClientRequests\Auth;

use App\Rules\CheckCaptchaRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
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
            'name'                 => 'bail|required|regex:/^[a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶ" +
            "ẸẺẼỀỀẾỂưăạảấầẩẫậắằẳẵặẹẻẽềềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợ" +
            "ụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]{2,30}+$/',
            'g_recaptcha' => ['bail', 'required', $this->capchaRule],
            'email' => ['bail', 'required', 'email','unique:users,email,NULL,id'],
            'password' => 'bail|required|min:6|max:16',
            're_password' => 'bail|required|same:password',
            'approve' => 'bail|required|in:yes',
            'affiliate_key' => 'bail|nullable|regex:/^[a-zA-Z0-9]{10}+$/',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Vui lòng nhập tên.'),
            'name.regex' => __('Tên không hợp lệ.'),
            'g_recaptcha.required' => __('Vui lòng xác nhận bạn không phải là máy.'),
            'email.required' => __('Vui lòng nhập email.'),
            'email.email' => __("Email không hợp lệ."),
            'email.unique'                  => __('Email đã tồn tại.'),
            'password.required' => __("Vui lòng nhập mật khẩu."),
            'password.min' => __("Mật khẩu phải chứa ít nhất 6 ký tự."),
            'password.max' => __("Mật khẩu tối đa 16 ký tự."),
            're_password.required' => __("Vui lòng nhập lại mật khẩu."),
            'approve.required' => __("Bạn chưa đồng ý với các điều khoản của chúng tôi."),
            'approve.in' => __("Bạn chưa đồng ý với các điều khoản của chúng tôi."),
            're_password.same' => __("Nhập lại mật khẩu không khớp"),
            'affiliate_key.regex' => __("Mã giới thiệu không hợp lệ."),
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
