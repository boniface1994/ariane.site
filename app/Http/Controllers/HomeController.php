<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configurator\QuarterAvailable;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\OrbitTypeParameter;
use App\Models\Configurator\CostCubesat;
use App\Models\Configurator\TechnicalMaturity;
use App\Models\Configurator\Option;
use App\Models\Configurator\FlightOpportunity;
use App\Models\Configurator\PriceList;
use App\Models\GeneralParameter;
use App\Models\Admin\Project\Document;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        return view('front.pages.home');
    }

    public function stepOne(){
        $quarter_available = QuarterAvailable::first();
        $month = $quarter_available['month'];
        $year = $quarter_available['year'];
        $q = strtoupper($quarter_available['quart']);
        $datenow = new \DateTime();
        $date = $datenow->format('Y-m-d');
        $quarters = array();
        $datetime = null;
        if(count($quarters) == 0){
            $quarters[] = date('Y-m-d',strtotime('+'.$month.' months',strtotime($date)));
            $datetime = new \DateTime($quarters[count($quarters)-1]);
            $years = $datetime->format('Y');
        }
        while ( (int)$years <= (int)$year) {
            $month +=$quarter_available['month'];
            $quarters[] = date('Y-m-d',strtotime('+'.$month.' months',strtotime($date)));
            $datetime = new \DateTime($quarters[count($quarters)-1]);
            $years = $datetime->format('Y');
        }
        
        $datas = array();
        foreach ($quarters as $quarter) {
            $date_q = new \DateTime($quarter);
            $annee = $date_q->format('Y');
            $datas[] = (object) array('annee'=>$annee,'date'=>$quarter);
        }
        return view('front.pages.welcome',compact('q','datas','year'));
    }

    public function oneTwo(Request $request){
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }

        return redirect('step_2');
    }

    public function stepTwo(){
        $orbites = OrbitType::orderBy('position','ASC')->get();
        return view('front.pages.steptwo',compact('orbites'));
    }

    public function twoThree(Request $request){
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }
        return redirect('step_3');
    }

    public function orbiteParameter($orbite_id){
        $parameters = OrbitTypeParameter::where('orbit_type_id','=',$orbite_id)->get();
        return response()->json($parameters);
    }

    public function stepThree(){
        return view('front.pages.stepthree');
    }

    public function threeFour(Request $request){
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }
        if(session('space_type') == 'cubsat')
            return redirect('/step_4_cubsat');
        return redirect('/step_4_smallsat');
    }

    public function stepCubesat(){
        $cubesats = CostCubesat::orderBy('id','asc')->get();
        return view('front.pages.stepfourCubesat',compact('cubesats'));
    }

    public function cubesatFive(Request $request){
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }
        $options = Option::where('dashboard_available','=',0)->where(session('space_type'),'=',1)->orderBy('position','asc')->get();
        $sessions =array();
        if(session('options')){
            $sessions = (array) json_decode(session('alloptions'));
        }
        $type = session('space_type');
        return \Redirect::route('step_five',['type'=>session('space_type')])->with(['options'=>$options,'type'=>$type,'sessions'=>$sessions]);
    }

    public function stepSmallsat(){
        $maturities = TechnicalMaturity::orderBy('position','asc')->get();
        $all = GeneralParameter::all();
        $parameters = array();
        if($all){
            foreach ($all as $parameter) {
                $parameters[$parameter->name] = $parameter->value; 
            }
        }
        return view('front.pages.stepfourSmallsat',compact('maturities','parameters'));
    }

    public function smallsatFive(Request $request){
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                \Session::put($key,$value);
            }
        }

        $options = Option::where('dashboard_available','=',0)->where(session('space_type'),'=',1)->orderBy('position','asc')->get();
        $sessions =array();
        if(session('alloptions')){
            $sessions = (array)json_decode(session('alloptions'));
        }
        if(is_object($sessions)){
            $sessions = (array) $sessions;
        }
        $type = session('space_type');
        return \Redirect::route('step_five',['type'=>session('space_type')])->with(['options'=>$options,'type'=>$type,'sessions'=>$sessions]);
    }

    public function stepFive($type){
        $options = Option::where('dashboard_available','=',0)->where($type,'=',1)->orderBy('position','asc')->get();
        $sessions =array();
        if(session('alloptions')){
            $sessions = (array) json_decode(session('alloptions'));
        }
        return view('front.pages.stepfive',compact('options','type','sessions'));
    }

    public function fiveSix(Request $request){
        \Session::put('alloptions',json_encode((object)$request->request->get('alloptions')));
        return redirect('/step_7');
    }

    public function stepSeven(){
        $type = session('space_type');
        $opportunities = FlightOpportunity::orderBy('position','asc')->get();
        if($type == "cubsat"){
            $type = 'cubesatt';
        }else{
            $type = 'smallsatt';
        }
        $all = GeneralParameter::all();
        $document = null;
        if($all){
            foreach ($all as $parameter) {
                if($type == $parameter->name)
                    $document = $parameter->value; 
            }
        }
        $lists = PriceList::all();
        $prices = array();
        foreach ($lists as $list) {
            $prices[$list->name] = $list->value;
        }
        $weight = null;
        $tarifs = null;
        if($type == 'smallsatt'){
            for($i=1;$i<=16;$i++){
                if(isset($prices['p'.$i]) && $prices['p'.$i] <= session('masse')){
                    $weight = $prices['p'.$i];
                    if(session('tarif') == 'tarif_leo'){
                        $tarifs = $prices['leo_p'.$i];
                    }
                    if(session('tarif') == 'tarif_gto'){
                        $tarifs = $prices['gto_p'.$i];
                    }
                    
                }
            }
        }else{
            if(session('cubesat')){
                if(session('tarif') == 'tarif_leo'){
                    $tarifs = $prices['leo_'.session('cubesat')];
                }
                if(session('tarif') == 'tarif_gto'){
                    $tarifs = $prices['gto_'.session('cubesat')];
                }
            }
        }
        $sessions =array();
        if(session('alloptions')){
            $sessions = (array) json_decode(session('alloptions'));
        }

        $all_options = Option::where('dashboard_available','=',0)->where(session('space_type'),'=',1)->orderBy('position','asc')->get();
        $options = array();
        foreach ($all_options as $key => $value) {
            if(in_array($value->id, $sessions))
                $options[] = $value;
        }
        return view('front.pages.stepseven',compact('opportunities','document','tarifs','options'));
    }
}
