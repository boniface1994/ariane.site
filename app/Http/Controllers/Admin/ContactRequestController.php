<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;

class ContactRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = ContactRequest::paginate(10);
        if(session('status')){
            $requests = ContactRequest::where([
                [function($query){
                    switch (session('status')) {
                        case 1:
                            $query->orWhere('status','=',1)->get();
                            break;
                        
                        case 0:
                            $query->orWhere('status','=',0)->get();
                            break;
                        
                        default:
                            $query->orWhere('status','=',0)->get();
                            $query->orWhere('status','=',1)->get();
                            break;
                    }
                }]
            ])->paginate(10);
        }
        return view('admin.pages.contactrequest.index',compact('requests'));
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
        //
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
        $contact_request = ContactRequest::find($id);
        $contact_request->status = $request->status;
        $contact_request->update();
        return response()->json($contact_request);
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

    public function search(Request $request){
        foreach($request->all() as $key=>$value){
            if($value != ''){
                \Session::put($key,$value);
            }
        }
        $requests = ContactRequest::where([
            [function($query) use ($request){
                switch ($request->status) {
                    case 1:
                        $query->orWhere('status','=',1)->get();
                        break;
                    
                    case 0:
                        $query->orWhere('status','=',0)->get();
                        break;
                    
                    default:
                        $query->orWhere('status','=',0)->get();
                        $query->orWhere('status','=',1)->get();
                        break;
                }
            }]
        ])->paginate(10);

        return view('admin.pages.contactrequest.index',compact('requests'));
    }

    public function resetSearch(){
        \Session::forget('status');
        return redirect('admin/request');
    }
}
