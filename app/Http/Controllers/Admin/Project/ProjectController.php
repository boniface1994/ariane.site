<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use App\Models\Customers\Customer;
use App\Models\Configurator\ScInterface;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\PropellantType;
use App\Models\Configurator\SupplierType;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        if(session('step') || session('customer') || session('valid') || session('received')){
            $projects = Project::where([
                [function($query){
                    switch (session('step')) {
                        case 1:
                            $query->orWhere('step_1','=',1)->get();
                            break;
                        
                        case 2:
                            $query->orWhere('step_2','=',1)->get();
                            break;

                        case 3:
                            $query->orWhere('step_3','=',1)->get();
                            break;

                        case 4:
                            $query->orWhere('step_4','=',1)->get();
                            break;
                        
                        case 5:
                            $query->orWhere('step_1','=',1)->get();
                            $query->orWhere('step_2','=',1)->get();
                            $query->orWhere('step_3','=',1)->get();
                            $query->orWhere('step_4','=',1)->get();
                            break;
                    }
                    if(($received = session('received'))){
                        $query->orWhere('received','=',1)->get();
                    }
                    if(($valid = session('valid'))){
                        $query->orWhere('valid','=',1)->get();
                    }
                    if(($customer = session('customer'))){
                        $query->orWhere('customer_id','=',$customer)->get();
                    }
                }]
            ])->paginate(10);
        }else{
            $projects = Project::paginate();
        }
        return view('admin.pages.project.index',compact('projects','customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $scInterfaces = ScInterface::all();
        $orbitTypes = OrbitType::all();
        $supplierTypes = SupplierType::all();
        $propellantTypes = PropellantType::all();
        return view('admin.pages.project.form',compact('project','scInterfaces','orbitTypes','supplierTypes','propellantTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->contact_ariane = $request->contact_ariane;
        $project->update();

        return redirect('admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect('admin/project');
    }

    public function projectSearch(Request $request){
        foreach($request->all() as $key=>$value){
            if($value != ''){
                \Session::put($key,$value);
            }
        }

        $projects = Project::where([
            [function($query) use ($request){
                switch ($request->step) {
                    case 1:
                        $query->orWhere('step_1','=',1)->get();
                        break;
                    
                    case 2:
                        $query->orWhere('step_2','=',1)->get();
                        break;

                    case 3:
                        $query->orWhere('step_3','=',1)->get();
                        break;

                    case 4:
                        $query->orWhere('step_4','=',1)->get();
                        break;
                    
                    case 5:
                        $query->orWhere('step_1','=',1)->get();
                        $query->orWhere('step_2','=',1)->get();
                        $query->orWhere('step_3','=',1)->get();
                        $query->orWhere('step_4','=',1)->get();
                        break;
                }
                if(($received = $request->received)){
                    $query->orWhere('received','=',1)->get();
                }
                if(($valid = $request->valid)){
                    $query->orWhere('valid','=',1)->get();
                }
                if(($customer = $request->customer)){
                    $query->orWhere('customer_id','=',$customer)->get();
                }
            }]
        ])->paginate(10);
        $customers = Customer::all();

        return view('admin.pages.project.index',compact('projects','customers'));
    }

    public function resetSearch(){
        \Session::forget('step');
        \Session::forget('customer');
        \Session::forget('valid');
        \Session::forget('received');
        var_dump('expression');
        return redirect('admin/project');
    }
}
