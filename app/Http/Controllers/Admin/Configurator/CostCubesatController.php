<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\Option;
use App\Models\Configurator\CostCubesat;
use App\Models\Configurator\OptionCostCubesat;

class CostCubesatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::where('cubsat','=',1)->where('weight_dependent','=',0)->get();
        $costCubesats = CostCubesat::orderBy('id')->get();
        return view('admin.pages.configurator.optioncostcubesat.index',compact('options','costCubesats'));
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
        $requireds = array();
        $validator ='';
        foreach ($data as $key => $item) {
            if (isset($item['data_cost'])) {
                foreach ($item['data_cost'] as $key => $value) {
                    $rules = array(  
                        'cost' => 'required'
                    );
                    $validator = Validator::make($value, $rules);
                }
            }

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => trans('Complete input required')
                ]);
            }else{
                try{

                    $object = CostCubesat::updateOrCreate(
                        [
                            'id' => $item['id']
                        ],
                        [
                            'name' => $item['name']
                        ]
                    );
                    $data_option_cost = array();
                    foreach ($item['data_cost'] as $key => $data_cost) {
                        $object_cost = OptionCostCubesat::updateOrCreate(
                            [
                                'id' => $data_cost['id']
                            ],
                            [
                                'option_id' => $data_cost['option_id'],
                                'cost_cubesat_id' => $object->id,
                                'cost' => $data_cost['cost']
                            ]
                        );
                        $data_option_cost[] = [
                            'option_cost_id' => $object_cost->id,
                            'option_id' => $object_cost->option_id
                        ];
                    }

                    $response_data[] = [
                        'id' => $object->id,
                        'name'=>$object->name,
                        'option_cost_cubesats' => $data_option_cost
                    ]; 

                }catch(\Exception $e){
                    return response()->json([
                        'error' => true,
                        'message' => $e->getMessage()
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
