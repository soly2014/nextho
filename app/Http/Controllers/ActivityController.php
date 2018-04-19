<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction};
use Carbon\Carbon;
use DB;
use PageTitle;


class ActivityController extends Controller {

    /**
     * [postActivity description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postActivity(Request $request){

            $this->validate($request, 
               [
                 'activity_type'           => 'not_in:1',
                 'description'             => 'max:5120',
                 'due_date'                => 'required'
               ]
            );
            
            $activity_type      = $request->activity_type;
            $due_date           = $request->due_date;
            $priority           = $request->priority;
            $description        = $request->description;
            
            $activitable_id     = $request->activitable_id;
            $activitable_type   = 'App\Models\\'.$request->activitable_type;
            
            $user               = auth()->user()->id;
            $activity_owner     = auth()->user()->id;

            if($request->activity_owner){
                $activity_owner = $request->activity_owner;
            }

            $new_date = date('Y-m-d H:i:s', strtotime($due_date)); 

            $activity = Activity::create(array(
                'type'              => $activity_type,
                'status'            => 3,
                'due_date'          => $new_date,
                'priority'          => 2,
                'description'       => $description,
                'activity_owner'    => $activity_owner,
                'created_by'        => $user,
                'marked_deleted'    => false,
                'activitable_id'    => $activitable_id,
                'activitable_type'  => $activitable_type
            ));
            
            if($activity){
                $now_dt = date('Y-m-d H:i:s');
                
                // if($activity_status == '4'){
                // 	$activity->update(array(
                // 		'closed_time'   => $now_dt,
                // 		'closed_by'     => $user
                // 	));
                	
                // 	$activity->action()->create(array(
	               //      'client_id'     =>  $activity->activitable_id,
	               //      'object_type'   =>  $activity->activitable_type,
	               //      'action_type'   =>  'Closed',
	               //      'date'          =>  $now_dt,
	               //      'created_by'    =>  $user
	               //  ));
                // }
                
                if($activity->activitable_type == "App\Models\Client"){
                    if($activity->activitable->newly_assigned){
                        $activity->activitable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    } else {
                        $activity->activitable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    }
                } else {
                    $activity->activitable->update(array(
                        'last_updated'  => $now_dt
                    ));
                }
                
                session()->flash('success', '<strong>Congratulations!</strong> The Activity has been Successfully Added.');
                return back();
            } else {

                session()->flash('error', '<strong>Error!</strong> The Activity is not Added, Error Occurred.');
                return  back();
            }
            
    }
    /**
     * [postActivities description]
     * @return [type] [description]
     */
    public function postActivities(){
        
    }
    /**
     * [getModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getModify($id){
        
        $user = auth()->user()->id;
        if(auth()->user()->userRole->view_any_activity){
            $activity = Activity::where('id', $id)->first();
        } else {
            $activity = Activity::where('id', $id)->where('marked_deleted', false)->whereNotIn('status', [4])->where('activity_owner', $user)->first();
        }
        
        if($activity){
            PageTitle::add('Modify Activity Details');
            return view('activities.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'activities',
                    'crumb_link' => ''
                    ])
                ]),
                'activity' => $activity
            ));
        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended Activity no longer exists or URL provided is invalid.');
            return redirect()->route('home');
        }
    }
    /**
     * [postModify description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function postModify(Request $request,$id){
        
             $this->validate($request, 
             array(
                 'activity_type'           => 'not_in:1',
                 'description'             => 'max:5120',
                 'due_date'                => 'required'
             )
            );

            $activity_type      = $request->type;
            $due_date           = $request->due_date;
            $priority           = 2;
            $description        = $request->description;
            
            $new_date = date('Y-m-d H:i:s', strtotime($due_date)); 

            $user = auth()->user()->id;
            if(auth()->user()->userRole->modify_any_activity){
                $activity = Activity::where('id', $id)->first();
            } else {
                $activity = Activity::where('id', $id)->where('marked_deleted', false)->whereNotIn('status', [4])->where('activity_owner', $user)->first();
            }
            
            if($activity){
                $action = $activity->update(array(
                    'type'              => $activity_type,
                    'due_date'          => $new_date,
                    'priority'          => $priority,
                    'description'       => $description,
                    'updated_by'        => $user
                ));
                
                if($action){
                    $now_dt = date('Y-m-d H:i:s');

                    if($activity->activitable_type == "App\Models\Client"){
                        if($activity->activitable->newly_assigned){
                            $activity->activitable->update(array(
                                'last_updated'  => $now_dt
                            ));
                        } else {
                            $activity->activitable->update(array(
                                'last_updated'  => $now_dt
                            ));
                        }
                    } else {
                        $activity->activitable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    }
                    
                      session()->flash('success', '<strong>Congratulations!</strong> The Activity has been Successfully Modified.');
                    return back();
                }
                
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the User intended Activity no longer exists or URL provided is invalid.');
                return redirect()->route('home');
            }
            
    }
    /**
     * [getSingle description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSingle($id){
        $user = auth()->user()->id;
        if(auth()->user()->userRole->view_any_activity){
            $activity = Activity::where('id', $id)->first();
        } else {
            $activity = Activity::where('id', $id)->where('marked_deleted', false)->where('activity_owner', $user)->first();
        }
        
        if($activity){
        
            PageTitle::add('View Activity Details');
            return view('activities.singleview', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'activities',
                    'crumb_link' => ''
                    ])
                ]),
                'activity' => $activity
            ));

        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended Activity no longer exists or URL provided is invalid.');
            return redirect()->route('home');
        }
    }
    /**
     * [postClose description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postClose($id){
        
        $user = auth()->user()->id;
        if(auth()->user()->userRole->close_any_activity){
            $activity = Activity::where('id', $id)->whereNotIn('status', [4])->first();
        } else {
            $activity = Activity::where('id', $id)->where('marked_deleted', 0)->whereNotIn('status', [4])->where('activity_owner', $user)->first();
        }
        
        if($activity){
            
            $now_dt = date('Y-m-d H:i:s');
            
            $close_activity = $activity->update(array(
                'status'        => 4,
                'closed_time'   => $now_dt,
                'closed_by'     => $user,
                'updated_by'    => $user
            ));
            
            if($close_activity){
                if($activity->activitable_type == "App\Models\Client"){
                    if($activity->activitable->newly_assigned){
                        $activity->activitable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    } else {
                        $activity->activitable->update(array(
                            'last_updated'  => $now_dt
                        ));
                    }
                } else {
                    $activity->activitable->update(array(
                        'last_updated'  => $now_dt
                    ));
                }
                
                $now_d  = date('Y-m-d');
                $activity->action()->create(array(
                    'client_id'     =>  $activity->activitable_id,
                    'object_type'   =>  $activity->activitable_type,
                    'action_type'   =>  'Closed',
                    'date'          =>  $now_d,
                    'created_by'    =>  $user
                ));
                
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity is now marked as Completed.');
                return back();
            }
            
        }else{
                session()->flash('error', '<strong>Error!</strong> Activity Not Found, This Activityis already marked as Completed, Doesn\'t exist anymore or The URL Provided is invalid.');
            return back();
        }
        
    }
    /**
     * [postDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postDelete($id){
        
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->delete_any_activity){
            $activity = Activity::where('id', $id)->where('marked_deleted', 0)->first();
        } else {
            $activity = Activity::where('id', $id)->where('marked_deleted', 0)->where('activity_owner', $user)->first();
        }
        
        if($activity){
            $now_dt = date('Y-m-d H:i:s');
            $activity_delete = $activity->update(array(
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ));
            
            if($activity_delete){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity is deleted successfully.');
                return back();
            }else{
                    session()->flash('error', '<strong>Error!</strong> Activity Not Found, This Activity Doesn\'t exist anymore or The URL Provided is invalid');
                return back();
            }
            
        }else{
                    session()->flash('error', '<strong>Error!</strong> You are not allowed to take any action regarding the intended activity.');
            return back();
        }
    }
    
    public function postRestore($id){
        
        if(auth()->user()->userRole->restore_any_activities){
            $activity = Activity::where('id', $id)->where('marked_deleted', true)->first();
        } else {
            $user = auth()->user()->id;
            $activity = Activity::where('id', $id)->where('marked_deleted', true)->where('activity_owner', $user)->first();
        }
        
        if($activity){
            $activity_restore = $activity->update(array(
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ));
            
            if($activity_restore){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity is Restored successfully.');
                return back();
            }else{
                    session()->flash('error', '<strong>Error!</strong> The Intended Activity is not found, is not Deleted or The URL Provided is invalid');
                return back();
            }
            
        }else{
                    session()->flash('error', '<strong>Error!</strong> The Intended Activity is not found or The URL Provided is invalid');
            return back();
        }
    }

}