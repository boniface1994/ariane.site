<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use App\Models\Admin\Project\Document;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\ScInterface;
use App\Models\Configurator\SupplierType;
use App\Models\Configurator\PropellantType;
use App\Models\Configurator\Option;
use App\Models\Configurator\OrbitTypeParameter;

class HomeController extends Controller
{
	// public function __construct(){
	// 	Auth::guard('customer')->logout();
	// }
    public function caracteristic($id){
    	$customer = Auth::guard('customer')->user();
    	$detail = Project::find($id);
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	$orbits = OrbitType::all();
    	$scinterfaces = ScInterface::all();
    	$suppliers = SupplierType::all();
    	$propellants = PropellantType::all();
    	return view ('front.pages.dashboard.caracteristic',compact('detail','projects','orbits','scinterfaces','suppliers','propellants'));
    }

    public function option($id){
    	$customer = Auth::guard('customer')->user();
    	$options = Option::all();
    	$detail = Project::find($id);
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	return view('front.pages.dashboard.option',compact('options','detail','projects'));
    }

    public function document($id){
    	$customer = Auth::guard('customer')->user();
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	$detail = Project::find($id);
    	$documents = Document::where('project_id','=',$id)->get();

    	return view('front.pages.dashboard.document',compact('detail','projects','documents'));
    }

    public function contact($id){
    	$customer = Auth::guard('customer')->user();
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	$detail = Project::find($id);

    	return view('front.pages.dashboard.contact',compact('detail','projects'));
    }

    public function ndaPage($id){
    	$customer = Auth::guard('customer')->user();
    	$projects = Project::where('customer_id','=',$customer->id)->orderBy('id','desc')->get();
    	$detail = Project::find($id);

    	return view('front.pages.dashboard.nda',compact('projects','detail'));
    }

    public function getNda($id){
    	$project = Project::find($id);
    	$customer = Auth::guard('customer')->user();
    	$data = [
            'customer' => $customer,
            'project' => $project,
            'date' => date("(jS) l \of F, Y")
        ];
          
        $pdf = PDF::loadView('front.pages.dashboard.nda-pdf', $data);
    
        return $pdf->download('nda.pdf');
    	// return view('front.pages.dashboard.nda');
    }

    public function updateProject(Request $request){
    	$project = Project::find($request->request->get('project_id'));
    	foreach ($request->all() as $key => $value) {
    		if($key != '_token' && $key != 'project_id'){
    			$project[$key] = $value;
    		}
    	}

    	$project->update();
    	dd($project);
    }

    public function uploadDoc(Request $request){
    	$validator = \Validator::make($request->all(), [
            'name' => 'required',
            'document' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withErrors($validator);
        }else{
            $ext = $request->file('document')->guessExtension();
            $document['ext'] = $ext;
            $document['type'] = $request->type;
            $document['name'] = $request->name.'.'.$ext;
            $document['project_id'] = $request->project_id;
            $name = $request->name.'.'.$ext;
            $request->file('document')->storeAs("upload",$name,'public');
            Document::create($document);
            $documents = Document::where('project_id','=',$request->project_id)->get();
            return \Redirect::route('project.document',$request->project_id);
         }
    }

    public function deleteDoc($id){
    	$document = Document::find($id);
    	$project_id = $document->project_id;
        $document->delete();
        return \Redirect::route('project.document',$project_id);
    }

    public function deleteProject($i){
    	$project = Project::find($id);
    	$project->delete();
    }

    public function getOrbitParameters($id){
    	$parameters = OrbitTypeParameter::where('orbit_type_id','=',$id)->get();

    	return response()->json($parameters);
    }
}
