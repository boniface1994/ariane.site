<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\ScInterface;

class ScInterfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interfaces = ScInterface::orderBy('position')->get();
        return view('admin.pages.configurator.scinterface.index', compact('interfaces'));
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
            'name'          => 'required',
            'sicubesat'     => 'required_without_all:sismallsat',
            'sismallsat'    => 'required_without_all:sicubesat'
        ]);

        if($validator->passes()) {
            $object = ScInterface::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'explication' => $request->explication,
                    'sicubesat' => $request->sicubesat,
                    'sismallsat' => $request->sismallsat,
                    'position' => $request->position,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ScInterface::destroy($id);

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
                $scinterface = ScInterface::find($id);
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
