<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CampaignController extends Controller {



    public function getAll(){
        
        if(auth()->user()->userRole->view_all_campaigns){
            $campaign = Campaign::orderBy('status', 'ASC')->get();
        } else {
            $campaign = Campaign::orderBy('status', 'ASC')->where('marked_deleted', false)->get();
        }
        PageTitle::add('View All Campaigns');
        return view('campaigns.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Campaigns',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'campaigns-view'
                ])
            ]),
            'campaigns' => $campaign
        ));
    }
    
    public function getSingle($id){

        if(auth()->user()->userRole->view_all_campaigns){
            $campaign = Campaign::where('id', $id)->first();
        } else {
            $campaign = Campaign::where('id', $id)->where('marked_deleted', false)->first();
        }
        //dd($campaign->clients()->wherePivot('marked_deleted', 0)->get()->toJson());
        if($campaign){
            
            $view_all_notes = auth()->user()->userRole->view_any_campaign_notes;
            $view_all_activities = auth()->user()->userRole->view_any_campaign_activities;
            $view_all_attachments = auth()->user()->userRole->view_any_campaign_attachments;
            $view_all_leads = auth()->user()->userRole->view_any_campaign_leads;
            
            $view_notes = auth()->user()->userRole->view_campaign_notes;
            $view_activities = auth()->user()->userRole->view_campaign_activities;
            $view_attachments = auth()->user()->userRole->view_campaign_attachments;
            $view_leads = auth()->user()->userRole->view_campaign_leads;
            
            $notes = [];
            $open_activities = [];
            $closed_activities = [];
            $attachments = [];
            $clients = [];
            
            $view_ui_notes = auth()->user()->userRole->view_campaign_ui_notes;
            $view_ui_activities = auth()->user()->userRole->view_campaign_ui_activities;
            $view_ui_attachments = auth()->user()->userRole->view_campaign_ui_attachments;
            $view_ui_clients = auth()->user()->userRole->view_campaign_ui_leads;
            
            //dd($view_ui_notes);
            
            $user = auth()->user()->id;
            
            if($view_ui_notes){
                if($view_all_notes){
                    $notes = $campaign->notes()->get()->load('userDeleted');
                } else if($view_notes){
                    $notes = $campaign->notes()->where('marked_deleted', 0)->get();
                } else {
                    $notes = $campaign->notes()->where('marked_deleted', 0)->where('note_owner', $user)->get();
                }
            }
            
            if($view_ui_activities){
                if($view_all_activities){
                    $open_activities = $campaign->activities()->whereNotIn('status', [4])->get()->load('userDeleted');
                    $closed_activities = $campaign->activities()->where('status', 4)->get()->load('userDeleted');
                } else if($view_activities){
                    $open_activities = $campaign->activities()->where('marked_deleted', 0)->whereNotIn('status', [4])->get();
                    $closed_activities = $campaign->activities()->where('marked_deleted', 0)->where('status', 4)->get();
                } else {
                    $open_activities = $campaign->activities()->where('marked_deleted', 0)->where('activity_owner', $user)->whereNotIn('status', [4])->get();
                    $closed_activities = $campaign->activities()->where('marked_deleted', 0)->where('activity_owner', $user)->where('status', 4)->get();
                }
            }
            
            if($view_ui_attachments){
                if($view_all_attachments){
                    $attachments = $campaign->attachments()->get()->load('userDeleted');
                } else if($view_attachments){
                    $attachments = $campaign->attachments()->where('marked_deleted', false)->get();
                } else {
                    $attachments = $campaign->attachments()->where('marked_deleted', false)->where('attachment_owner', $user)->get();
                }
            }
            
            if($view_ui_clients){
                if($view_all_leads){
                    $clients = $campaign->clients()->get();
                } else if($view_leads){
                    $clients = $campaign->clients()->wherePivot('marked_deleted', 0)->get();
                } else {
                    $clients = $campaign->clients()->wherePivot('relation_owner', $user)->get();
                }
            }
            $add_notes      = auth()->user()->userRole->add_campaign_note;
            $add_attachment = auth()->user()->userRole->add_campaign_attachment;
            $add_activity   = auth()->user()->userRole->add_campaign_activity;
            
            PageTitle::add('Single View Details');
            return view('campaigns.singleview', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Campaigns',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'View All',
                        'crumb_link' => 'campaigns-view-single'
                    ])
                ]),
                'object'                => $campaign,
                'notes'                 => $notes,
                'open_activities'       => $open_activities,
                'completed_activities'  => $closed_activities,
                'attachments'           => $attachments,
                'clients'               => $clients,
                'view_notes'            => $view_ui_notes,
                'view_activities'       => $view_ui_activities,
                'view_attachments'      => $view_ui_attachments,
                'view_clients'          => $view_ui_clients,
                'add_note'              => $add_notes,
                'add_attachment'        => $add_attachment,
                'add_activity'          => $add_activity,
                'model_type'            => 'Campaign'
            ));
        } else {
            return route('campaigns-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Campaign you are looking for either no longer exists or The URL Provided is invalid .');
        }
        
        
    }
    public function getCreate(){
        
        PageTitle::add('Create A Campaign');
        return view('campaigns.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Campaigns',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Create Campaign',
                    'crumb_link' => 'campaigns-create'
                ])
            ])
        ));
    }
    public function postCreate(){
        
        PageTitle::add('Create A Campaign');
        
        $validator = $this->validate($request, 
             array(
                 'name'             => 'required',
                 'start_date'       => 'required',
                 'description'      => 'max:5120'
             )
        );

        if($validator -> fails()) {
            return route('campaigns-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $name           = Input::get('name');
            $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
            $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));
            $stauts         = Input::get('status');
            $type           = Input::get('type');
            $description    = Input::get('description');
            
            $user           = auth()->user()->id;

            $lead_source = ClientSource::create(array(
                'label'         =>('Campaign - '.$name),
                'published'     => true,
                'created_by'    => $user
            ));
            if($lead_source){
                
                $campaign = Campaign::create(array(
                    'name'              => $name,
                    'type'              => $type,
                    'status'            => $stauts,
                    'start_date'        => $start_date,
                    'end_date'          => $end_date,
                    'description'       => $description,
                    'source_id'         => $lead_source->id,
                    'created_by'        => $user,
                    'marked_deleted'    => false
                ));

                if($campaign){

                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('campaigns-view-single', array($campaign->id));
                    } else if($submit == "save-new"){
                        return route('campaigns-create')
                            ->with('success', '<strong>Congratulations!</strong> The new Campaign "'.$name.'" has been created successfully.');
                    } else {
                        return route('campaigns-view')
                            ->with('success', '<strong>Congratulations!</strong> The new Campaign "'.$name.'" has been created successfully.');
                    }   
                }
            }
        }
    }
    public function getModify($id){
        
        if(auth()->user()->userRole->view_all_campaigns){
            $campaign = Campaign::where('id', $id)->first();
        } else {
            $campaign = Campaign::where('id', $id)->where('marked_deleted', false)->first();
        }
        
        if($campaign){
            
            PageTitle::add('Modify Campaign Details');
            return view('campaigns.modify', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Campaigns',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'Edit Campaign',
                        'crumb_link' => 'campaigns-modify-single'
                    ])
                ]),
                'campaign'                => $campaign
            ));
        } else {
            return route('campaigns-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Campaign you are looking for either no longer exists or The .');
        }
    }
    
    public function postModify($id){
        
        if(auth()->user()->userRole->view_all_campaigns){
            $campaign = Campaign::where('id', $id)->first();
        } else {
            $campaign = Campaign::where('id', $id)->where('marked_deleted', false)->first();
        }

        if($campaign){  
            $validator = $this->validate($request, 
                 array(
                     'name'             => 'required',
                     'start_date'       => 'required',
                     'description'      => 'max:5120'
                 )
                );

            if($validator -> fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $name           = Input::get('name');
                $start_date     = date('Y-m-d', strtotime(Input::get('start_date')));
                $end_date       = date('Y-m-d', strtotime(Input::get('end_date')));
                $stauts         = Input::get('status');
                $type           = Input::get('type');
                $description    = Input::get('description');

                $user           = auth()->user()->id;

                $query = $campaign->update(array(
                    'name'              => $name,
                    'type'              => $type,
                    'status'            => $stauts,
                    'start_date'        => $start_date,
                    'end_date'          => $end_date,
                    'description'       => $description,
                    'updated_by'        => $user
                ));
                
                $campaign->leadSource->update(array(
                    'label'         => ('Campaign - '.$name),
                    'updated_by'    => $user
                ));

                if($query){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('campaigns-view-single', array($campaign->id))
                            ->with('success', '<strong>Congratulations!</strong> The Campaign "'.$name.'" has been modified successfully.');
                    } else if($submit == "save-new"){
                        return route('campaigns-create')
                            ->with('success', '<strong>Congratulations!</strong> The Campaign "'.$name.'" has been modified successfully.');
                    } else {
                        return route('campaigns-view')
                            ->with('success', '<strong>Congratulations!</strong> The Campaign "'.$name.'" has been modified successfully.');
                    }   
                }
            }
        }
    }
    
    public function postDelete($id){
        $campaign = Campaign::where('id', $id)->where('marked_deleted', false)->first();
        
        if($campaign){
            $now_dt = date('Y-m-d H:i:s');
            $user = auth()->user()->id;
            $op = $campaign->update(array(
                'marked_deleted'    => true,
                'deleted_at'        => $now_dt,
                'deleted_by'        => $user
            ));
            
            if($op){
                return route('campaigns-view')
                    ->with('success', '<strong>Congratulations!</strong> The Campaign "'.$campaign->name.'" is deleted successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> The Intended Campaign is already deleted or the provided URL is invalid');
        }
    }    
    
    public function postRestore($id){
        $campaign = Campaign::where('id', $id)->where('marked_deleted', true)->first();
        
        if($campaign){
            $now_dt = date('Y-m-d H:i:s');
            $user = auth()->user()->id;
            $op = $campaign->update(array(
                'marked_deleted'    => false,
                'deleted_at'        => null,
                'deleted_by'        => null
            ));
            
            if($op){
                return route('campaigns-view-single', array($campaign->id))
                    ->with('success', '<strong>Congratulations!</strong> The Campaign "'.$campaign->name.'" is Restored successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> The Intended Campaign is already not deleted or the provided URL is invalid');
        }
    }

}
