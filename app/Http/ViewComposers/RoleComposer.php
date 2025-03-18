<?php

namespace App\Http\ViewComposers;

use Robbo\Presenter\View\View;
use Spatie\Permission\Models\Role;

class RoleComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $view->with('roles', Role::all());
    }
}
