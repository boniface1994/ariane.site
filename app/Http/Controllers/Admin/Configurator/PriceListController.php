<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configurator\PriceList;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = PriceList::all();
        $pricelists = array();
        if($all){
            foreach ($all as $price) {
                $pricelists[$price->name] = $price->value; 
            }
        }
        return view('admin.pages.configurator.pricelist.price-list',compact('pricelists'));
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
        $pricelists = PriceList::all();
        $names= array();
        if($pricelists){
            foreach ($pricelists as $key => $value) {
                $names[] = $value->name;
            }
        }
        $input['smallsat'] = $request->request->get('smallsat');
        $input['cubesat'] = $request->request->get('cubesat');
        if($names){
            foreach ($request->all() as $key => $value) {
                if(in_array($key,$names)){
                    if($key != "_token" && $key != "cubesat" && $key != "smallsat"){
                        $pricelist = PriceList::where(['name' => $key])->first();
                        $pricelist->value = $value;
                        $pricelist->update();
                    }
                }else{
                    if($key != "_token" && $key != "cubesat" && $key != "smallsat"){
                        $input['name'] = $key;
                        $input['value'] = $value;
                        PriceList::create($input);
                    }
                }
            }
        }else{
            foreach ($request->all() as $key => $value) {
                if($key != "_token" && $key != "cubesat" && $key != "smallsat"){
                    $input['name'] = $key;
                    $input['value'] = $value;
                    PriceList::create($input);
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
