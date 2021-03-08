<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\PropellantType;

class PropellantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propellanttypes = PropellantType::orderBy('position')->get();
        return view('admin.pages.configurator.propellanttype.index', compact('propellanttypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [   
            'name' => 'required'
        ]);

        if($validator->passes()) {
            $object = PropellantType::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'explication' => $request->explication,
                    'position' => $request->position,
                ]
            );

            return response()->json(
                [
                    'success' => true,
                    'id' => $object->id,
                    'name' => $request->name,
                    'delete_url' => route('propellanttype.destroy', $object->id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PropellantType::destroy($id);

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
                $scinterface = PropellantType::find($id);
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
