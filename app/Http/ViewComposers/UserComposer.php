<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use Robbo\Presenter\View\View;

class UserComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $view->with('users', User::all());
    }
}
