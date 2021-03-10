<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configurator\Option;
use App\Models\Configurator\OptionCost;
use App\Models\Configurator\OptionCostOption;
use Illuminate\Support\Facades\Validator;

class OptionCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::where('smallsat','=',1)->where('weight_dependent','=',0)->get();
        $optionCosts = OptionCost::orderBy('mass_max','asc')->get();
        return view('admin.pages.configurator.optioncost.index',compact('options','optionCosts'));
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
        foreach ($data as $key => $item) {
            if (isset($item['data_cost'])) {
                foreach ($item['data_cost'] as $key => $value) {
                    $rules = array(  
                        'cost' => 'required'
                    );
                    $validator = Validator::make($value, $rules);

                    if ($validator->fails()) {
                        return response()->json([
                            'error' => true,
                            'message' => trans('Complete input required')
                        ]);
                    }
                }
            }

            $rules = array(    
                'mass_min' => 'required',
                'mass_max' => 'required'
            );
            $validator = Validator::make($item, $rules);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => trans('Complete input required')
                ]);
            }else{
                try{

                    $object = OptionCost::updateOrCreate(
                        [
                            'id' => $item['id']
                        ],
                        [
                            'mass_min' => $item['mass_min'],
                            'mass_max' => $item['mass_max']
                        ]
                    );
                    $data_option_cost = array();
                    foreach ($item['data_cost'] as $key => $data_cost) {
                        $object_cost = OptionCostOption::updateOrCreate(
                            [
                                'id' => $data_cost['id']
                            ],
                            [
                                'option_id' => $data_cost['option_id'],
                                'option_cost_id' => $object->id,
                                'cost' => $data_cost['cost']
                            ]
                        );
                        $data_option_cost[] =  [ 
                            'option_cost_option_id' => $object_cost->id,
                            'option_id' => $object_cost->option_id
                        ];
                    }

                    $response_data[] = [
                        'id' => $object->id,
                        'position' => $item['position'],
                        'option_cost_option' => $data_option_cost,
                        'delete_url' => route('option-cost.destroy', $object->id)
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
        OptionCost::destroy($id);

        return response()->json(
            [
                'success' => true,
                'id' => $id
            ]
        );
    }
}
