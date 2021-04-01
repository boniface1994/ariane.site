<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configurator\QuarterAvailable;
use App\Models\Configurator\OrbitType;
use App\Models\Configurator\OrbitTypeParameter;
use App\Models\Configurator\CostCubesat;
use App\Models\Configurator\TechnicalMaturity;
use App\Models\Configurator\Option;
use App\Models\GeneralParameter;

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
        // var_dump($datas);die();
        return view('front.pages.welcome',compact('q','datas','year'));
    }

    public function stepTwo(){
        $orbites = OrbitType::orderBy('position','ASC')->get();
        // echo "<pre>";
        // var_dump($orbites);
        // echo "</pre>";
        // die();
        return view('front.pages.steptwo',compact('orbites'));
    }

    public function orbiteParameter($orbite_id){
        $parameters = OrbitTypeParameter::where('orbit_type_id','=',$orbite_id)->get();
        return response()->json($parameters);
    }

    public function stepThree(){
        return view('front.pages.stepthree');
    }

    public function stepCubesat(){
        $cubesats = CostCubesat::orderBy('id','asc')->get();
        return view('front.pages.stepfourCubesat',compact('cubesats'));
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

    public function stepFive($type){
        $options = Option::where('dashboard_available','=',0)->where($type,'=',1)->orderBy('position','asc')->get();

        return view('front.pages.stepfive',compact('options','type'));
    }

    public function stepSeven(){
        return view('front.pages.stepseven');
    }
}
