<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('quan-ly');
        } else {
            return redirect('dang-nhap');
        }
    }

    public function dashboard()
    {
        return view(parent::CLIENT_VIEW . "user.dashboard");
    }
}
