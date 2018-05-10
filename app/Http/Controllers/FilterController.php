<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction};
use Carbon\Carbon;
use DB;
use PageTitle;

class FilterController extends Controller
{

    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function filterActivity(Request $request)
    {

    	$operator = $request->type == 'personal' ? '=' : '!=';
    	$date      = Carbon::parse($request->date);

        $activities = Activity::where('marked_deleted', false)
						            ->where(function($query)use($date,$operator) {
						                $query->where('activity_owner', auth()->user()->id)
                                              ->where('created_by',$operator, auth()->user()->id)
                                              ->where('closed_by',null)
						                      ->whereDate('due_date',$date->toDateString());
						            })->orderBy('due_date', 'ASC')->get()->load('activityType', 'activitable');
        $view = view('filter.activity',compact('activities'))->render();

        return response()->json(['html'=>$view,'type'=>$request->type]);

    }


}
