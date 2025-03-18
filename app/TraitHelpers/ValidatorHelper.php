<?php


namespace App\TraitHelpers;


trait ValidatorHelper
{


    public function isEmail($value)
    {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value);
    }
}
