<?php

namespace App\Http\Controllers\Admin\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configurator\Quarter;
use App\Models\Configurator\QuarterAvailable;
use Illuminate\Support\Facades\Validator;

class QuarterAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quarters = Quarter::all();
        $quarterAvailable = QuarterAvailable::first();
        return view('admin.pages.configurator.quarter.index',compact('quarters','quarterAvailable'));
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
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'quarter' => 'required', 
            'month' => 'required'
        ]);
        if ($validator->passes()) {
            $input['year'] = $request->year;
            $input['month'] = $request->month;
            $input['quart'] = $request->quarter;
            $input['user_id'] = \Auth::user()->id;
            $quarterAvailable = QuarterAvailable::create($input);

            return response()->json($quarterAvailable);
        }
        return response()->json(['error'=>$validator->errors()]);
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
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
            'quarter' => 'required'
        ]);
        
        if ($validator->passes()) {
            $quarterAvailable = QuarterAvailable::find($id);
            $quarterAvailable->year = $request->year;
            $quarterAvailable->month = $request->month;
            $quarterAvailable->user_id = \Auth::user()->id;
            $quarterAvailable->quart = $request->quarter;
            $quarterAvailable->save();
            return response()->json($quarterAvailable);
        }
        return response()->json(['error'=>$validator->errors()]);
        
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
