<?php

namespace App\Http\ViewComposers;

use Auth;
use Robbo\Presenter\View\View;

/*use View;*/


class LoggedComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $view->with('userLogged', Auth::user());
    }
}
