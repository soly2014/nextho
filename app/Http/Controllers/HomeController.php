<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction};
use Carbon\Carbon;
use DB;
use PageTitle;
// use ConsoleTVs\Charts\Charts;

class HomeController extends Controller {

    
    public function getDashboard(){


        
        $Today      = Carbon::today();
        
        $Highest    = Carbon::today()->addDays(5);
        $High       = Carbon::today()->addDays(3);
        $Normal     = Carbon::today()->addDays(1);
        $Low        = Carbon::today();
        $Lowest     = Carbon::today();
        
        $priority_highest  = 1;
        $priority_high     = 2;
        $priority_normal   = 3;
        $priority_low      = 4;
        $priority_lowest   = 5;
        
       
        
        $logged_in = auth()->user()->id;
        
        $activities = Activity::where('marked_deleted', false)
            ->where(function($query) use($Today, $logged_in){
                $query->where('activity_owner', $logged_in)
                      ->where('created_by', $logged_in);
            })->orderBy('due_date', 'ASC')->get()->load('activityType', 'activitable');
        
        $other_activities = Activity::where('marked_deleted', false)
            ->where(function($query) use($Today, $logged_in){
                $query->where('activity_owner', $logged_in)
                      ->where('created_by','!=', $logged_in);
            })->orderBy('due_date', 'ASC')->get()->load('activityType', 'activitable');
        
        // dd($other_activities);
        
        $year = $Today->year;
        

/**
 * check if user is Admin
 */
if(auth()->user()->role_id != 1){

			//->where('approved', true)->where('year', $year)->groupBy('month', 'year')->get()->toJson();
			$soldProperties = auth()->user()->soldProperties()->selectRaw('sum(price) as aggregate, month')->where('year', $year)->where('approved', true)->groupBy('month', 'year')->orderBy('month', 'ASC')->pluck('aggregate', 'month');

			$forecasts = Forecast::where('marked_deleted', false)->where('year', $year)->orderBy('month')->pluck('amount', 'month');

			//dd($soldProperties[1]);

			$this_month = $Today->month;

            $target = [];
            $data   = [];
            $calls = []; 
            $meetings = [];                       
            for($i =1 ; $i <= 12; $i++){
                    if(isset($soldProperties[($i)]) && array_key_exists(($i), $soldProperties)){
                        $data[]   = $soldProperties[($i)];
                    } else {
                        $data[]   = 0;
                    }
                    if(\App\Models\Forecast::where(['month'=>$i,'year'=>$Today->year,'agent_id'=>auth()->user()->id])->first()){
                        $target[]   = \App\Models\Forecast::where(['month'=>$i,'year'=>$Today->year,'agent_id'=>auth()->user()->id])->sum('amount');
                    } else {
                        $target[]   = 0;
                    }
                    // get count calls
                    if ($count = auth()->user()->notesCreated()->whereMonth('created_at',$i)->whereYear('created_at',$Today->year)->where('activity_type',3)->count()) {
                        $calls[] = $count;
                    }else {
                        $calls[] = 0;
                    }
                    // get count calls
                    if ($count = auth()->user()->notesCreated()->whereMonth('created_at',$i)->whereYear('created_at',$Today->year)->where('activity_type',4)->count()) {
                        $meetings[] = $count;
                    }else {
                        $meetings[] = 0;
                    }
                    

            }

        $target   = array_add($target,12,array_sum($target)); 
        $data     = array_add($data,12,array_sum($data)); 
        $calls    = array_add($calls,12,array_sum($calls)); 
        $meetings = array_add($meetings,12,array_sum($meetings)); 

			//New Leads
			$new_leads = auth()->user()->clientsAssigned()->where('newly_assigned', true)->where('marked_deleted', false)->where('is_customer', false)->count();
			
            

 } else {
        

            $soldProperties = ClientProperty::selectRaw('sum(price) as aggregate, month')->where('year', $year)->where('approved', true)->groupBy('month', 'year')->orderBy('month', 'ASC')->pluck('aggregate', 'month')->toArray();
            //dd($soldProperties);

            
            $current = Carbon::today();
            $current_year = $current->year;
            //$current_month = $current->month;

            
             // dd($forecasts);

            $this_month = $Today->month;

            $Months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            $target = [];
            $data   = [];
            $calls = []; 
            $meetings = [];           
            for($i =1 ; $i <= 12; $i++){
                    if(isset($soldProperties[($i)]) && array_key_exists(($i), $soldProperties)){
                        $data[]   = $soldProperties[($i)];
                    } else {
                        $data[]   = 0;
                    }
                    if(\App\Models\Forecast::where(['month'=>$i,'year'=>$Today->year])->first()){
                        $target[]   = \App\Models\Forecast::where(['month'=>$i,'year'=>$Today->year])->sum('amount');
                    } else {
                        $target[]   = 0;
                    }
                    // get count calls
                    if ($count = \App\Models\Note::whereMonth('created_at',$i)->whereYear('created_at',$Today->year)->where('activity_type',3)->count()) {
                        $calls[] = $count;
                    }else {
                        $calls[] = 0;
                    }
                    // get count calls
                    if ($count = \App\Models\Note::whereMonth('created_at',$i)->whereYear('created_at',$Today->year)->where('activity_type',4)->count()) {
                        $meetings[] = $count;
                    }else {
                        $meetings[] = 0;
                    }


         }

        $target   = array_add($target,12,array_sum($target)); 
        $data     = array_add($data,12,array_sum($data)); 
        $calls    = array_add($calls,12,array_sum($calls)); 
        $meetings = array_add($meetings,12,array_sum($meetings)); 
			
			////////////////////////////////////////////////////

		
			//New Leads
			$new_leads = Client::where('newly_assigned', true)->where('marked_deleted', false)->where('is_customer', false)->where('assigned_to', auth()->user()->id)->count();

            
        }



        PageTitle::add('Dashboard');
        
	return view('dashboard', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Dashboard',
                    'crumb_link' => ''
                ])
            ]),
            'activities'            => $activities,//
            'other_activities'      => $other_activities,//other_activities
            'data'                  => $data,
            'target'                => $target,
            'meetings'              => $meetings,
            'calls'                 => $calls,
            'new_leads'             => $new_leads
        ));
	}

}