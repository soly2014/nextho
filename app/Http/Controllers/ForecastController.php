<?php 

namespace App\Http\Controllers;

use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Note,Attachment,Forcast};
use Illuminate\Http\Request;
use PageTitle;


class ForecastController extends Controller {


    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll(){
        $forecasts = Forecast::all()->load('associatedRole', 'userCreated');
        
        PageTitle::add('View All Forecasts');
        return view('forecasts.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Forecasts',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'forecast-view'
                ])
            ]),
            'forecasts' => $forecasts
        ));
    }
    /**
     * [getCreate description]
     * @return [type] [description]
     */
    public function getCreate(){
        
        
        PageTitle::add('Create A New Forecast');
        return view('forecasts.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Forecasts',
                    'crumb_link' => 'forecast-view'
                ])
                ,array([
                    'crumb_name' => 'Create Forecast',
                    'crumb_link' => ''
                ])
            ])
        ));
    }
    /**
     * [postCreate description]
     * @return [type] [description]
     */
    public function postCreate(Request $request){


        $year = $request->year;
             $this->validate($request, 
                 array(
                     'amount' => 'required|integer'
                 )
            );

            $user = auth()->user()->id;
            
            $year   = $request->year;
            $month  = $request->month;
            $agent   = (int)$request->agent_id;
            $amount = $request->amount;

            if (Forecast::where(['month'=>$month,'year'=>$year,'agent_id'=>$agent])->exists()) {
                    session()->flash('error', '<strong>Damn!</strong> This Forecast Added Before.');
                    return back();
            }

            
            $forecast = Forecast::create(array(
                'month'             => $month,
                'year'              => $year,
                'amount'            => $amount,
                'agent_id'          => $agent,
                'role_id'           => 2,
                'created_by'        => $user,
                'marked_deleted'    => false
            ));
            
            if($forecast){
                    session()->flash('success', '<strong>Congratulations!</strong> The Forecast has been Successfully Added.');
                return redirect()->route('forecast-view');
            }
        
    }
    /**
     * [getSingle description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSingle($id){
        $forecast = Forecast::where('id', $id)->first();
        if($forecast){
            PageTitle::add('View Forecast Details');
            return view('forecasts.singleview', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Forecasts',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'View All',
                        'crumb_link' => 'forecast-view'
                    ])
                ]),
                'forecast'  => $forecast
            ));
        } else {
                    session()->flash('error', '<strong>Errow!</strong> The Forecast inteded doesn\'t exists, or the provided URL not found.');
            return redirect()->route('forecast-view');
        }
    }
    /**
     * [getModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getModify($id){
        $forecast = Forecast::where('id', $id)->first();
        if($forecast){
            PageTitle::add('Modify Forecast Details');
            return view('forecasts.modify', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Forecasts',
                        'crumb_link' => 'forecast-view'
                    ])
                    ,array([
                        'crumb_name' => 'Modify Forecast',
                        'crumb_link' => ''
                    ])
                ]),
                'forecast'  => $forecast
            ));
        } else {
                    session()->flash('error', '<strong>Errow!</strong> The Forecast inteded doesn\'t exists, or the provided URL not found.');
            return redirect()->route('forecast-view');
        }
    }
    /**
     * [postModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postModify(Request $request,$id){
// dd($request->all());
        $forecast = Forecast::where('id', $id)->first();
        
        if($forecast){
            $year = $request->year;

            $validator = $this->validate($request, 
                 array(
                     'amount'             => 'required|integer',
                     'month'              => $month_validator
                 )
            );

            if (($forecast->month != $request->month || $forecast->year != $request->year) && Forecast::where(['month'=>$month,'year'=>$year,'agent_id'=>$agent])->exists()) {
                    session()->flash('error', '<strong>Damn!</strong> This Forecast Added Before.');
                    return back();
            }

            $user = auth()->user()->id;

            $year   = $request->year;
            $month  = $request->month;
            $role   = $request->role_id;
            $amount = $request->amount;

            $update = $forecast->update(array(
                'month'             => $month,
                'year'              => $year,
                'amount'            => $amount,
                'role_id'           => $role,
                'updated_by'        => $user
            ));

            if($forecast){
                    session()->flash('success', '<strong>Congratulations!</strong> The Forecast has been Successfully Added.');
                return redirect()->route('forecast-view');
            }
        } else {
                    session()->flash('error', '<strong>Errow!</strong> The Forecast inteded doesn\'t exists, or the provided URL not found.');
            return redirect()->route('forecast-view');
        }
    }

}
