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
        $errors = array();
        if(!$request->name) $errors[] = trans('Name is required');
        if(!$request->sicubesat && !$request->sismallsat) $errors[] = trans('Type is required');

        if(count($errors) == 0) {
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
                    'delete_url' => route('scinterface.destroy', $object->id)
                ]
            );
        }
        else {
            return response()->json([
                'error' => true,
                'errors' => $errors
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
}
