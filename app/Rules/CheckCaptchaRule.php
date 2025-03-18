<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\GoogleCapcha\ValidateCapchaService;

class CheckCaptchaRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $capcha;
    public function __construct(ValidateCapchaService $capcha)
    {
        $this->capcha=$capcha;
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
        return $this->capcha->validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Xác nhận capcha!');
    }
}
