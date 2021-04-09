<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    

    public function login(){
    	return view('front.pages.signin.login');
    }

    public function timeline(){
    	return view('front.pages.dashboard.timeline');
    }
}
