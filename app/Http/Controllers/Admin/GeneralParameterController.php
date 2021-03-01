<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralParameter;
use Illuminate\Support\Facades\Hash;

class GeneralParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = GeneralParameter::all();
        $parameters = array();
        if($all){
            foreach ($all as $parameter) {
                $parameters[$parameter->name] = $parameter->value; 
            }
        }

        return view('admin.pages.dashboard.general-parameter',compact('parameters'));
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
        $parameters = GeneralParameter::all();
        $names= array();
        if($parameters){
            foreach ($parameters as $key => $value) {
                $names[] = $value->name;
            }
        }
        if($names){
            foreach ($request->all() as $key => $value) {
                if(in_array($key,$names)){
                    if($key != "_token"){
                        $parameter = GeneralParameter::where(['name' => $key])->first();
                        if($key == "cubesatt" || $key == "smallsatt"){
                            $ext = $request->file($key)->guessExtension();
                            $name = md5($request->file($key)->getClientOriginalName()).'.'.$ext;
                            $value = $name ;
                            $request->file($key)->storeAs("upload",$name,'public');
                        }
                        $parameter->value = $value;
                        $parameter->update();
                    }
                }else{
                    if($key != "_token"){
                        if($key == "cubesatt" || $key == "smallsatt"){
                            $ext = $request->file($key)->guessExtension();
                            $name = md5($request->file($key)->getClientOriginalName()).'.'.$ext;
                            $value = $name;
                            $request->file($key)->storeAs("upload",$name,'public');
                        }
                        $input['name'] = $key;
                        $input['value'] = $value;
                        GeneralParameter::create($input);
                    }
                }
            }
        }else{
            foreach ($request->all() as $key => $value) {
                if($key != "_token"){
                    if($key == "cubesatt" || $key == "smallsatt"){
                        $ext = $request->file($key)->guessExtension();
                        $name = md5($request->file($key)->getClientOriginalName()).'.'.$ext;
                        $value = $name;
                        $request->file($key)->storeAs("upload",$name,'public');
                    }
                    $input['name'] = $key;
                    $input['value'] = $value;
                    GeneralParameter::create($input);
                }
            }
        }
        if(isset($request->smallsatt) || isset($request->cubesatt))
        {
            return redirect('admin/parameter');
        }
        return response()->json($request->all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadPdf($name){
        $pdf = public_path("upload/".$name);
        $headers = ['Content-Type: application/pdf'];
        $newName = time().'.pdf';

        return response()->download($pdf, $newName, $headers);
    }
}
