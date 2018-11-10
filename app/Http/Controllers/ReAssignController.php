<?php 

namespace App\Http\Controllers;

use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Note,Attachment,CampaignClient};
use Illuminate\Http\Request;
use PageTitle;
use DataTables;

use App\Models\Customer;

class ReAssignController extends Controller {
    

    /**
     * [getFilter description]
     * @return [type] [description]
     */
    public function getFilter(){
            
        PageTitle::add('Re Assign Leads Filter');
        return view('clients.re-assign.filterleads', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Leads',
                    'crumb_link' => 'leads-view'
                ])
                ,array([
                    'crumb_name' => 'Re Assign',
                    'crumb_link' => ''
                ])
            ])
        ));
    }


    /**
     * [postFilter description]
     * @return [type] [description]
     */
    public function postFilter(Request $request){

            $messages = array(
                'required' => 'You Have to choose a User to assign the selected leads to.'
            );

             $this->validate($request, 
                 array(
                     'not_assigned_to'      => 'required'
                 ),
                 $messages
            );


            $assigned_to        = $request->assigned_to == null  ?  []:$request->assigned_to;
            $not_assigned_to    = $request->not_assigned_to == null  ?  [] :$request->not_assigned_to;
            $lead_source        = $request->lead_source  == null ? [] :$request->lead_source;
            $lead_status        = $request->lead_status == null  ?  [] :$request->lead_status;
            $unit_types         = $request->unit_types == null  ?  [] :$request->unit_types;
            $unit_district      = $request->unit_district == null  ?  [] :$request->unit_district;
            $last_activity_in   = $request->last_activity;

             if($last_activity_in != ""){    
                $last_activity      = date('Y-m-d', strtotime($last_activity_in));
            } else {
                $last_activity = null;
            }


            $leads = Client::where('pending_conversion', false)->where('marked_deleted', false);
            $del_val = '';


            if($not_assigned_to != ""){
                $leads = $leads->where('assigned_to', '<>', $not_assigned_to);
            }

            if(($key = array_search($del_val, $assigned_to)) !== false) {
                unset($assigned_to[$key]);
            }

            if(COUNT($assigned_to) > 0){

                $leads = $leads->whereIn('assigned_to', $assigned_to);
            }

            if(($key = array_search($del_val, $lead_source)) !== false) {
                unset($lead_source[$key]);
            }

            if(COUNT($lead_source) > 0){
                $leads = $leads->whereIn('client_source_id', $lead_source);
            }

            if(($key = array_search($del_val, $lead_status)) !== false) {
                unset($lead_status[$key]);
            }

            if(COUNT($lead_status) > 0){
                $leads = $leads->whereIn('client_status_id', $lead_status);
            }

            if(($key = array_search($del_val, $unit_district)) !== false) {
                unset($unit_district[$key]);
            }
            if(COUNT($unit_district) > 0){
                $leads = $leads->whereIn('interested_district', $unit_district);
            }

            if(($key = array_search($del_val, $unit_types)) !== false) {
                unset($unit_types[$key]);
            }
            if(COUNT($unit_types) > 0){
                $leads = $leads->whereIn('interested_type', $unit_types);
            } 
            if($last_activity){
                $leads = $leads->where('last_updated', '<', $last_activity);
            }

             $leads = $leads->pluck('id')->toArray();

            session()->put('leads', $leads);
            session()->put('assign_to', $not_assigned_to);

            return redirect()->route('leads-assign-selection');
    }

    /**
     * [getLeads description]
     * @return [type] [description]
     */
    public function getLeads(){

        $leads = null;
        $assign_to = null;
        if(\Session::has('leads') && \Session::has('assign_to')){
            $leads      = \Session::get('leads');
            $assign_to  = \Session::get('assign_to');
        } else {
            return redirect()->route('leads-assign-filter');
        }
        
        PageTitle::add('Re Assign Leads Filter');


        return view('clients.re-assign.display-leads', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Leads',
                    'crumb_link' => 'leads-view'
                ])
                ,array([
                    'crumb_name' => 'Re Assign',
                    'crumb_link' => ''
                ])
            ]),
            'leads'     => $leads,
            'assign_to' => $assign_to
        ));
    }
    
    /**
     * [postLeads description]
     * @return [type] [description]
     */
    public function postLeads(Request $request){


        $assign_to      = $request->assign_to;
        $leads          = $request->leads;
        $notes          = $request->notes ? false : true;
        $activity       = $request->activity ? false : true;
        $attachments    = $request->attachments ? false : true;
        $campaigns      = $request->campaign ? false : true;
        
        $user           = auth()->user()->id;
        $date           = date("Y-m-d H:i:s");
        
        $clients = Client::whereIn('id', $leads)->update(array(
            'assigned_to'           => $assign_to,
            'last_updated_by'       => $user,
            'show_notes'            => $notes,
            'show_all_activities'   => $activity,
            'show_all_attachements' => $attachments,
            'show_all_campaigns'    => $campaigns,
            'newly_assigned'        => true,
            'converted'        => true
        ));
                
        if($clients){
            $activities = Activity::whereIn('activitable_id', $leads)->update(array(
                'activity_owner'    => $assign_to
            ));
            $notes = Note::whereIn('noteable_id', $leads)->update(array(
                'note_owner'    => $assign_to
            ));
            $attachments = Attachment::whereIn('attachable_id', $leads)->update(array(
                'attachment_owner'  => $assign_to
            ));
            $campaign_client_relation = CampaignClient::whereIn('client_id', $leads)->update(array(
                'relation_owner'  => $assign_to
            ));
            
            $reassigned_leads = array();
            foreach($leads as $key => $lead) {
                $reassigned_leads[$key]['client_id']    = $lead;
                $reassigned_leads[$key]['user_id']      = $assign_to;
                $reassigned_leads[$key]['created_by']   = $user;
                $reassigned_leads[$key]['created_at']   = $date;
                $reassigned_leads[$key]['updated_at']   = $date;
            }

            $process = ClientUser::insert($reassigned_leads);
            if($process){
                    session()->flash('success', '<strong>Congratulations!</strong> The Selected Leads have been Re-Assigned successfully.');
                return redirect()->route('leads-assign-filter');
            }
        }
    }
    


    /**
     * [reformArray description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function reformArray($array){
        $del_val = '';
        if(($key = array_search($del_val, $array)) !== false) {
            unset($array[$key]);
        }
        
        return $array;
    }
    
    
    /**
     * [datatables description]
     * @return [type] [description]
     */
    public function datatable($leads,Request $request)
    {
        $leads = null;
        $assign_to = null;
        if(\Session::has('leads') && \Session::has('assign_to')){
            $leads      = \Session::get('leads');
            $assign_to  = \Session::get('assign_to');
            $leads = Client::whereIn('id',$leads);
          
                            
        } else {
            return redirect()->route('leads-assign-filter');
        }

        

            return DataTables::of($leads->select("*"))

                    ->rawColumns(['id', 'phone', 'assigned', 'source','status','create'])
                    ->filterColumn('name', function($query, $keyword) {
                        // $sql = "CONCAT(clients.first_name,'-',clients.last_name)  like ?";
                        $query->where('name', ["%{$keyword}%"]);
                    })
                    ->addColumn('id', function ($query) {
                        return '<input type="checkbox" class="lol" name="leads[]"  data-parsley-mincheck="1" data-parsley-error-message="You have to choose at least One lead to be able to procced." data-parsley-multiple="mymultiplelink" data-parsley-errors-container="#errors" id="lead'.$query->id.'" value="'.$query->id.'">';
                    })

                    ->addColumn('name', function ($query) {
                        return $query->name.' '.$query->last_name;
                    })

                    ->addColumn('phone', function ($query) {
                        return $query->mobile;
                    })

                    ->addColumn('assigned', function ($query) {
                        return $query->userAssigned->username ;
                    })

                    ->addColumn('source', function ($query) {
                        return  $query->source ? $query->source->label : 'source';
                    })

                    ->addColumn('status', function ($query) {
                        return $query->status ? $query->status->label : 'status';
                    })

                    ->addColumn('create', function ($query) {
                        return $query->created_at;
                    })

                    ->filter(function ($query) use ($request) {
                        if ($request->has('source')) {
                            $query->where('source', 'like', "%{$request->get('source')}%");
                        }
                    })    

                    ->make(true);

    }
    

    /**
     * [searchLeads description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function searchLeads(Request $request)
    {

// dd(json_decode($request->leads_ids));

       $leads = Client::whereIn('id',json_decode($request->leads_ids));

       if ($request->lead_source != "17") {
            $leads = $leads->where('client_source_id',$request->lead_source);
       }

       if ($request->lead_status != "9") {
            $leads = $leads->where('client_status_id',$request->lead_status);
       }

       if ($request->interested_type != "10") {
            $leads = $leads->where('interested_type',$request->interested_type);
       }

       if ($request->interested_district != "1") {
            $leads = $leads->where('interested_district',$request->interested_district);
       }


       if ($request->is_customer && $request->is_customer == "on") {
            $leads = $leads->where('is_customer',1);
       }

       if ($request->no_action && $request->no_action == "on") {
            $leads = $leads->where('newly_assigned',1);
       }


       if ($request->expired && $request->expired == "on") {
            $arr = [];
            $new_leads = $leads;
            foreach ($new_leads->get() as $lead) {
                $length = 0;
                if ($lead->notes() && $lead->notes()->orderBy('updated_at','desc')->first()) {
                        $end = $lead->notes()->orderBy('updated_at','desc')->first()->updated_at;
                        $now = \Carbon\Carbon::now();
                        $length = $end->diffInDays($now);
                }
                if ($length > 30) {
                  $arr[] = $lead->id;
                }
            }

            $leads = $leads->whereIn('id',$arr);
       }


        session()->put('leads', $leads->pluck('id')->toArray());

        PageTitle::add('Re Assign Leads Filter');

        return view('clients.re-assign.display-leads', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Leads',
                    'crumb_link' => 'leads-view'
                ])
                ,array([
                    'crumb_name' => 'Re Assign',
                    'crumb_link' => ''
                ])
            ]),
            'leads'     => json_decode($request->leads_ids),
            'assign_to' => $request->assign_to,
            'type' => 'leads'
        ));


    }


}

