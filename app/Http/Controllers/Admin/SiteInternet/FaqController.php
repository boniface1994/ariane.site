<?php

namespace App\Http\Controllers\Admin\SiteInternet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SiteInternet\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('position')->get();
        return view('admin.pages.siteinternet.faq.index', compact('faqs'));
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
        // if(!$request->question) $errors[] = trans('Question is required');
        // if(!$request->answer) $errors[] = trans('Answer is required');

        $validator = Validator::make($request->all(), [   
            'question' => 'required', 
            'answer' => 'required'
        ]);

        if($validator->passes()) {
            try{

                $object = Faq::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'question' => $request->question,
                        'answer' => $request->answer,
                        'position' => $request->position
                    ]
                );

                return response()->json(
                    [
                        'success' => true,
                        'id' => $object->id,
                        'question' => $request->question,
                        'delete_url' => route('technical.destroy', $object->id)
                    ]
                );

            }catch(\Exception $e){
                return response()->json([
                    'error' => true,
                    'errors' => [$e->getMessage()]
                ]);
            }
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
        Faq::destroy($id);

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
                $scinterface = Faq::find($id);
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
