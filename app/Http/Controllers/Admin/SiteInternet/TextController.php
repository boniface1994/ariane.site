<?php

namespace App\Http\Controllers\Admin\SiteInternet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInternet\Text;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $texts = Text::paginate(10);
        if(session('slug')  || session('contenue')){
            $texts = Text::where([
                [function($query){
                    if(($slug = session('slug'))){
                        $query->orWhere('slug','like','%'.$slug)->get();
                    }
                    if(($contenue = session('contenue'))){
                        $query->orWhere('contenue','like','%'.$contenue)->get();
                    }
                }]
            ])->paginate(10);
        }
        return view('admin.pages.siteinternet.text.index',compact('texts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.siteinternet.text.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'contenue' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withErrors($validator);
        }else{
            $text['slug'] = $request->slug;
            $text['description'] = $request->description;
            $text['contenue'] = $request->contenue;
            Text::create($text);
        }
        return redirect('admin/site-internet/text');
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
        $text = Text::find($id);
        return view('admin.pages.siteinternet.text.form',compact('text'));
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
        $validator = \Validator::make($request->all(), [
            'contenue' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withErrors($validator);
        }else{
            $text = Text::find($id);
            $text->slug = $request->slug;
            $text->description = $request->description;
            $text->contenue = $request->contenue;
            $text->update();
        }
        return redirect('admin/site-internet/text');
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

    public function resetSearch(){
        \Session::forget('slug');
        \Session::forget('contenue');
        return redirect('admin/site-internet/text');
    }
}
