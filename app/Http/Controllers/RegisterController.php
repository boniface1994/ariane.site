<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailConfirmation;
use App\Models\Customers\Customer;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function signin(){
    	return view('front.pages.signin.signin');
    }

    public function register(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'company' => 'required',
            'password' => 'required|min:6',
            'confirm' => 'same:password',
            'project_name' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }else{
        	$customer  = new Customer();
            $customer->name = $request->name;
            $customer->company = $request->company;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->phone_company = $request->phone_company;
            $customer->street = $request->street;
            $customer->postal_code = $request->postal_code;
            $customer->function = $request->function;
            $customer->state = $request->state;
            $customer->city = $request->city;
            $customer->country = $request->country;
            $customer->password = Hash::make($request->password);
            $customer->save();

            $project['name'] = $request->project_name;
            $project['ltan'] = session('ltan') ? 1 : 0 ;
            $project['ltdn'] = session('ltdn') ? 1 : 0 ;
            $project['customer_id'] = $customer->id;
            $project['altitude_max'] = session('max_alt') ? session('max_alt') : 0;
            $project['altitude_min'] = session('min_alt') ? session('min_alt') : 0;
            $project['inclination_max'] = session('max_inc') ? session('max_inc') : 0;
            $project['inclination_min'] = session('min_inc') ? session('min_inc') : 0;
            $project['step'] = 1;
            $project['latitude'] = session('altitude') ? session('altitude') : '';
            $project['inclination'] = session('inclination') ? session('inclination') : '';
            $project['step_alt'] = session('step_alt') ? session('step_alt') : '';
            $project['step_inc'] = session('step_inc') ? session('step_inc') : '';
            $project['local_start'] = session('local_start') ? session('local_start') : '';
            $project['local_end'] = session('local_end') ? session('local_end') : '';
            $project['constraint'] = session('constraint') ? session('constraint') : '';
            Project::create($project);

            $valueArray = [
                'name' => $request->name,
                'email'=>$request->email,
                'message'=>'Vous recevez cet email car nous avons reçu une demande d\'inscription pour votre compte ce courrier. :)',
                'url_confirm'=>url("/confirm_email/".$customer->id)
            ];
            Mail::to($customer->email)->send(new MailConfirmation($valueArray));

            return redirect('/connect');
         }
            
    }

    public function confirm($id){
    	$customer = Customer::find($id);
    	$customer->enabled = 1;
    	$customer->update();
    	return redirect('/front-login');
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
