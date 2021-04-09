<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function signin(){
    	return view('front.pages.signin.signin');
    }

    public function beforeLogin(){
    	return view('front.pages.signin.before-login');
    }

    public function toLogin(Request $request){
    	foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }
        return redirect('/front-login');
    }
}
