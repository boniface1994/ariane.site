<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\TechnicalMaturity;

class TechnicalMaturityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maturities = TechnicalMaturity::orderBy('position')->get();
        return view('admin.pages.configurator.maturity.index', compact('maturities'));
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
                'title' => 'required'
            );
            $validator = Validator::make($item, $rules);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => trans('Title is required')
                ]);
            }else{
                try{

                    $object = TechnicalMaturity::updateOrCreate(
                        [
                            'id' => $item['id']
                        ],
                        [
                            'title' => $item['title'],
                            'position' => $item['position'],
                            'user_id' => $request['user_id']
                        ]
                    );

                    $response_data[] = [
                        'id' => $object->id,
                        'position' => $item['position'],
                        'delete_url' => route('technical.destroy', $object->id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TechnicalMaturity::destroy($id);

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
                $scinterface = TechnicalMaturity::find($id);
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
