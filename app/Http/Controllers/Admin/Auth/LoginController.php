<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout','loginForm']);
    }

    public function loginForm(Request $request){
        if(Auth::guard('admin')->user()){
            return redirect()->route('admin.home');
        }
        return view('admin.pages.auth.login');
    }

    public function login(Request $request){
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.home');
        } 
    }

    // public function authenticated(){
    //     $user = request()->user();

    //     if($user->hasRole(['admin', 'superadmin'])){
    //         return redirect()->route('admin.home');
    //     }

    //     return redirect('/');
    // }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
