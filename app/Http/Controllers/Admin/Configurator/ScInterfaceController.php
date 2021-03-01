<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $interfaces = ScInterface::all();
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
        // $errors = array();

        // if(empty($request->name)) $errors = array('name', 'Name is required');
        // if(empty($request->sicubesat) && empty($request->sismallsat)) $errors = array('type', 'This field is required');

        // return response()->json([
        //         'success' => false,
        //         'errors' => $errors
        //     ]);

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
                'id' => $object->id
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ScInterface::destroy($request->id);

        return response()->json(
            [
                'success' => true,
                'id' => $request->id
            ]
        );
    }
}
