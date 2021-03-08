<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Configurator\FlightOpportunity;
use App\Models\Configurator\OrbitType;

class FlightOpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orbittypes = OrbitType::orderBy('name')->get();
        $flightopportunities = FlightOpportunity::orderBy('position')->get();
        return view('admin.pages.configurator.flightopportunity.index', compact(['orbittypes', 'flightopportunities']));
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
            'month'     => 'required',
            'year'      => 'required',
            'name'      => 'required',
            'altitude'  => 'required|numeric',
            'inclination' => 'required|numeric',
            'orbit_type_id' => 'required'
        ]);

        if($validator->passes()) {
            $flightopportunity = FlightOpportunity::updateOrCreate(
                [
                    'id'            => $request->id
                ],
                [
                    'month'         => $request->month,
                    'year'          => $request->year,
                    'name'          => $request->name,                
                    'altitude'      => $request->altitude,
                    'inclination'   => $request->inclination,
                    'local_hour'    => $request->local_hour,
                    'local_minute'  => $request->local_minute,
                    'ltan'          => $request->ltan,
                    'ltdn'          => $request->ltdn,
                    'position'      => $request->position,
                    'orbit_type_id' => $request->orbit_type_id
                ]
            );

            return response()->json(
                [
                    'success' => true,
                    'id' => $flightopportunity->id,
                    'name' => $request->name,
                    'delete_url' => route('flightopportunity.destroy', $flightopportunity->id)
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
        FlightOpportunity::destroy($id);

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
                $scinterface = FlightOpportunity::find($id);
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
