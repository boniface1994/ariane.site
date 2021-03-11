<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $documents = Document::where('project_id','=',$project_id)->get();
        return view('admin.pages.project.document',compact('documents','project_id'));
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'document' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withErrors($validator);
        }else{
            $ext = $request->file('document')->guessExtension();
            $document['ext'] = $ext;
            $document['type'] = $request->type;
            $document['name'] = $request->name.'.'.$ext;
            $document['project_id'] = $request->project_id;
            $name = $request->name.'.'.$ext;
            $request->file('document')->storeAs("upload",$name,'public');
            Document::create($document);
            $documents = Document::where('project_id','=',$request->project_id)->get();
            return \Redirect::route('document',$request->project_id)->with(['documents' => $documents]);
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
        $document = Document::find($id);
        $project_id = $document->project_id;
        $document->delete();
        $documents = Document::where('project_id','=',$project_id)->get();
        return \Redirect::route('document',$project_id)->with(['documents' => $documents]);
    }
}
