<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configurator\SupplierType;

class SupplierTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliertypes = SupplierType::orderBy('position')->get();
        return view('admin.pages.configurator.suppliertype.index', compact('suppliertypes'));
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
        if(!$request->name) $errors[] = trans('Supplier type is required');
        if(!$request->sicubesat && !$request->sismallsat) $errors[] = trans('Si type is required');

        if(count($errors) == 0) {
            $object = SupplierType::updateOrCreate(
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
                    'delete_url' => route('suppliertype.destroy', $object->id)
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
        SupplierType::destroy($id);

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
                $scinterface = SupplierType::find($id);
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
