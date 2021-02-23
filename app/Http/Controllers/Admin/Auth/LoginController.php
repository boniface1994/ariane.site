<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm(Request $request){
        return view('admin.pages.auth.login');
    }

    public function authenticated(){
        $user = request()->user();

        if($user->hasRole(['admin', 'superadmin'])){
            return redirect()->route('admin.home');
        }

        return redirect('/');
    }
}
