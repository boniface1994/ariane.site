<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configurator\SatelitePosition;

class SatelitePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = SatelitePosition::all();
        $sateliteposition = array();
        if($all){
            foreach ($all as $satelite) {
                $sateliteposition[$satelite->name] = $satelite->value; 
            }
        }
        return view('admin.pages.configurator.sateliteposition.index',compact('sateliteposition'));
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
        $satelitepositions = SatelitePosition::all();
        $names= array();
        if($satelitepositions){
            foreach ($satelitepositions as $key => $value) {
                $names[] = $value->name;
            }
        }
        if($names){
            foreach ($request->all() as $key => $value) {
                if(in_array($key,$names)){
                    if($key != "_token"){
                        $sateliteposition = SatelitePosition::where(['name' => $key])->first();
                        $sateliteposition->value = $value;
                        $sateliteposition->update();
                    }
                }else{
                    if($key != "_token"){
                        $input['name'] = $key;
                        $input['value'] = $value;
                        SatelitePosition::create($input);
                    }
                }
            }
        }else{
            foreach ($request->all() as $key => $value) {
                if($key != "_token"){
                    $input['name'] = $key;
                    $input['value'] = $value;
                    SatelitePosition::create($input);
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
