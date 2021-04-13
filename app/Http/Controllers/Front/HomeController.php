<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{
    public function caracteristic($id){
    	$customer = Auth::guard('customer')->user();
    	$detail = Project::find($id);
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	return view ('front.pages.dashboard.caracteristic',compact('detail','projects'));
    }

    public function getNda($id){
    	$project = Project::find($id);
    	$customer = Auth::guard('customer')->user();
    	$data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('front.pages.dashboard.nda', $data);
    
        return $pdf->download('nda.pdf');
    	// return view('front.pages.dashboard.nda');
    }
}
