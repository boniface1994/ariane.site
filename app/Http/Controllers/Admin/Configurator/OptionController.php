<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::orderBy('position')->get();
        return view('admin.pages.configurator.option.index',compact('options'));
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
        $errors = array();
        $validator = Validator::make($request->all(), [   
            'name' => 'required', 
            'cubsat' => 'required_without_all:smallsat',
            'smallsat' => 'required_without_all:cubsat',
            'weight_dependent' => 'required'
        ]);

        if($validator->passes()) {
            $object = Option::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'explication' => $request->explication,
                    'cubsat' => $request->cubesat,
                    'smallsat' => $request->smallsat,
                    'position' => $request->position,
                    'cost' => $request->cost,
                    'weight_dependent' => $request->weight_dependent,
                    'dashboard_available' => $request->dashboard_available
                ]
            );

            return response()->json(
                [
                    'success' => true,
                    'id' => $object->id,
                    'name' => $request->name,
                    'delete_url' => route('scinterface.destroy', $object->id)
                ]
            );
        }
        else {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }
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
        Option::destroy($id);

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
                $option = Option::find($id);
                $option->update(
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
