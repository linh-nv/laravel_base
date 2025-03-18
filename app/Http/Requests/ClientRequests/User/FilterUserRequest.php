<?php

namespace App\Http\Requests\ClientRequests\User;

use App\Http\Requests\BaseFilterRequest;
use App\Rules\CheckCaptchaRule;
use App\TraitHelpers\ConfigTrait;

class FilterUserRequest extends BaseFilterRequest
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
        $parentRules = parent::rules();
        $rules = [
            'search_key' => 'bail|nullable|max:100',
            'role' => 'bail|nullable|exists:roles,name',
            'status_id' => 'bail|nullable|in:'.implode(',', $this->getValidValues(config('status.user'))),
        ];
        return array_merge($parentRules, $rules);

    }

    public
    function messages()
    {
        $messages = [
            'search_key.max' => __(':attribute không hợp lệ.', ['attribute' => 'Từ khoá']),
            'role.exists' => __("Loại người dùng không hợp lệ"),
            'status_id.in' => __("Trạng thái không hợp lệ"),
        ];
        $parentMessages = parent::messages();
        return array_merge($parentMessages, $messages);
    }
}
