<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Project;

class LoginController extends Controller
{
	// protected $redirectTo = '/timeline';
    // public function __construct()
    // {
    //     $this->middleware('guest:customer')->except('logout');
    // }

    public function login(){
    	if(Auth::guard('customer')->user()){
    		return \Redirect::route('timeline',['project_id'=>2]);
    	}
    	return view('front.pages.signin.login');
    }

    public function logout(){
    	Auth::guard('customer')->logout();
        return redirect('/before-login');
    }

    public function timeline($id=null){
    	$detail = null;
    	$customer = Auth::guard('customer')->user();
    	if($customer->enabled){
    		if ($id) {
    			$detail= Project::find($id);
    		}
	    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
	    	return view('front.pages.dashboard.timeline',compact('projects','detail'));
	    }else{
	    	Auth::guard('customer')->logout();
	    	return view('front.pages.dashboard.enabled');
	    }
    }

    public function loginrequest(Request $request){
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return \Redirect::route('/timeline',['project_id'=>null]);
        } 
        return redirect('/before-login');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }
}
