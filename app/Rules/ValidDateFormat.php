<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class ValidDateFormat implements Rule
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
        $d = DateTime::createFromFormat('d/m/Y', $value);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return ($d && $d->format('d/m/Y') === $value)||$value=='';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Ngày tháng không đúng định dạng');
    }
}
