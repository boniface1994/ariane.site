<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralParameter;

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
                        $parameter->value = $value;
                        $parameter->update();
                    }
                }else{
                    if($key != "_token"){
                        $input['name'] = $key;
                        $input['value'] = $value;
                        GeneralParameter::create($input);
                    }
                }
            }
        }else{
            foreach ($request->all() as $key => $value) {
                if($key != "_token"){
                    $input['name'] = $key;
                    $input['value'] = $value;
                    GeneralParameter::create($input);
                }
            }
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
}
