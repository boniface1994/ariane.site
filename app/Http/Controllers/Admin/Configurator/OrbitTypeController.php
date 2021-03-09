<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\OrbitTypeParameter;

class OrbitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orbittypes = OrbitType::with('parameters')->orderBy('position')->get();
        return view('admin.pages.configurator.orbittype.index', compact('orbittypes'));
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
 
        foreach ($data as $key => $item) {
            
            $rules = array(    
                'name' => 'required', 
                'orbit_leo' => 'required_without_all:orbit_sso',
                'orbit_sso' => 'required_without_all:orbit_leo',
                'tarif_leo' => 'required_without_all:tarif_gto',
                'tarif_gto' => 'required_without_all:tarif_leo',
            );
            $validator = Validator::make($item, $rules);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'errors' => $validator->errors()
                ]);
            }else{
                try{

                    if(!isset($item['parameters'])) {
                        return response()->json([
                            'error' => true,
                            'errors' => [trans('Altitude or inclination setting is required')]
                        ]);
                    }else {
                        foreach ($item['parameters'] as $i => $option) {
                            $option_rules = array(    
                                'type' => 'required',
                                'start' => 'required|numeric',
                                'end' => 'required|numeric',
                                'jump' => 'required|numeric',
                            );

                            $option_validator = Validator::make($option, $option_rules);
                            if ($option_validator->fails()) {
                               return response()->json([
                                    'error' => true,
                                    'errors' => $option_validator->errors()
                                ]); 
                            }
                        }
                    }

                    $orbittype = OrbitType::updateOrCreate(
                        [
                            'id'        => $item['id']
                        ],
                        [
                            'name'      => $item['name'],
                            'explication' => $item['explanation'],
                            'orbit_leo' => $item['orbit_leo'],
                            'orbit_sso' => $item['orbit_sso'],
                            'tarif_leo' => $item['tarif_leo'],
                            'tarif_gto' => $item['tarif_gto'],
                            'position'  => $item['position'],
                        ]
                    );

                    $id_option_altitude = null;
                    $id_option_inclination = null;

                    foreach ($item['parameters'] as $i => $option) {
                       
                        $parameter = $orbittype->parameters()->updateOrCreate(
                            [
                                'id'    => $option['id']
                            ],
                            [
                                'type'  => $option['type'],
                                'start' => $option['start'],
                                'end'   => $option['end'],
                                'jump'  => $option['jump'],
                                'orbit_type_id'  => $orbittype->id
                            ]
                        );

                        if($option['type'] == "altitude") $id_option_altitude = $parameter->id;
                        else $id_option_inclination = $parameter->id;

                    }

                    $response_data[] = [
                        'orbittype_id' => $orbittype->id,
                        'id_option_altitude' => $id_option_altitude,
                        'id_option_inclination' => $id_option_inclination,
                        'name' => $item['name'],
                        'position' => $item['position'],
                        'delete_url' => route('orbittype.destroy', $orbittype->id)
                    ]; 

                }catch(\Exception $e){
                    return response()->json([
                        'error' => true,
                        'erros' => [$e->getMessage()]
                    ]);
                }
            }
        }

        return response()->json(
            [
                'success' => true,
                'response_data' => $response_data
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrbitType::destroy($id);

        return response()->json(
            [
                'success' => true,
                'id' => $id
            ]
        );
    }

    public function updatePosition(Request $request) {
        foreach ($request->data as $position => $id) {
            if($id) {
                $scinterface = OrbitType::find($id);
                $scinterface->update(
                    [
                        'id' => $id,
                        'position' => $position
                    ]
                );
            }
        }

        return response()->json(
            [
                'success' => true
            ]
        );
    }
}
