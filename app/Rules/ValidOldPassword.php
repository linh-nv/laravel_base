<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class ValidOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userLogged = \Auth::user();
        return \Hash::check($value,$userLogged->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Mật khẩu cũ không đúng');
    }
}
