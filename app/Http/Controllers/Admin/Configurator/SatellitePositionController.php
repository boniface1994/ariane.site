<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\SatellitePositionCharacteristic;
use App\Models\Configurator\SatellitePosition;

class SatellitePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = SatellitePositionCharacteristic::with('positions')->get();
        $satellitepositions = array();

        if($all) {
            
            foreach ($all as $key => $item) {
                $satellitepositions[$item->name]['id'] = $item->id;
                $satellitepositions[$item->name]['max_height'] = $item->max_height;
                $satellitepositions[$item->name]['max_length'] = $item->max_length;
                $satellitepositions[$item->name]['max_width']  = $item->max_width;
                $satellitepositions[$item->name]['max_mass']   = $item->max_mass;

                if($item->positions) {
                    foreach ($item->positions as $id => $position)
                    $satellitepositions[$item->name]['position'][]   = $position->position;
                }
            }
        }

        return view('admin.pages.configurator.satelliteposition.index',compact('satellitepositions'));
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
        $data = $request->data;
        $response_data = array();

        foreach ($data as $name => $characteristic) {
            $validator = Validator::make($characteristic, [   
                'max_height' => 'nullable|numeric',
                'max_length' => 'nullable|numeric',
                'max_width'  => 'nullable|numeric',
                'max_mass'   => 'nullable|numeric'
            ]);
        }
        if($validator->passes()) {

            foreach ($data as $name => $characteristic) {

                $satellitepositioncharacteristic = SatellitePositionCharacteristic::updateOrCreate(
                    [
                        'id'        => $characteristic['id']
                    ],
                    [
                        'name'      => $name,
                        'max_height'=> $characteristic['max_height'],
                        'max_length'=> $characteristic['max_length'],
                        'max_width' => $characteristic['max_width'],
                        'max_mass'  => $characteristic['max_mass']
                    ]
                );

                $response_data[] = [
                    'id' => $satellitepositioncharacteristic->id,
                    'name' => $name
                ]; 

                if(isset($characteristic['position'])) {
                    foreach ($characteristic['position'] as $key => $position) {
                               
                        $satelliteposition = $satellitepositioncharacteristic->positions()->updateOrCreate(
                            [
                                'position'  => $position
                            ],
                            [
                                'satellite_position_characteristic_id'  => $satellitepositioncharacteristic->id
                            ]
                        );

                    }
                }
            }
        }
        else {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        return response()->json([
                'success' => true,
                'response_data' => $response_data
        ]);
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
