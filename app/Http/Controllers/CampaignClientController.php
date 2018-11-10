<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CampaignClientController extends Controller {
    
    public function postCampaignClient($id){
        if(auth()->user()->userRole->view_all_leads){
            $client = Client::where('id', $id)->where('marked_deleted', 0)->first();
        } else {
            $client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
        }
        
        if($client){
            $campaign_id = Input::get('campaign_id');
            //dd($campaign_id);
            if(!$campaign_id){
                return Redirect::back()
                    ->with('error', '<strong>Error!</strong> You have to provide a Campaign To Complete the Action.');
            }
            $client_id = $id;
            $member_status = Input::get('member_status');
            
            $user = auth()->user()->id;
            
            $Query = CampaignClient::create(array(
                'campaign_id'       => $campaign_id,
                'client_id'         => $client_id,
                'relation_owner'    => $user,
                'member_status'     => $member_status,
                'added_by'          => $user,
                'marked_deleted'    => false
            ));
            
            if($Query){
                $now_dt = date('Y-m-d H:i:s');
                if($Query->Client->newly_assigned){
                    $Query->Client->update(array(
                        'newly_assigned'    => false,
                        'last_updated'      => $now_dt
                    ));
                } else {
                    $Query->Client->update(array(
                        'last_updated'      => $now_dt
                    ));
                }
                return Redirect::back()
                    ->with('success', '<strong>Congratulations!</strong> The Campaign is added to the Client Successfully.');
            } else {
                return Redirect::back()
                    ->with('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists or is no longer Assigned to you.');
            }
        }
    }
    
    public function postCampaignClientDelete($id){
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->delete_any_campaign_client_relation){
            $client_campaign = CampaignClient::where('id', $id)->first();
        } else {
            $client_campaign = CampaignClient::where('id', $id)->where('relation_owner', $user)->where('marked_deleted', false)->first();
        }
        
        if($client_campaign){
            $now_dt = date("Y-m-d H:i:s");
            $query = $client_campaign->update(array(
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ));
            
            if($query){
                return Redirect::back()
                    ->with('success', '<strong>Congratulations!</strong> The Campaign-Client(Relation) is deleted from the Client successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error,</strong> Relation Not Found, Either the client is not linked to that campaign or The URL Provided is invalid, please try again!');
        }
    }    
    
    public function postCampaignClientRestore($id){
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->restore_any_campaign_client_relation){
            $client_campaign = CampaignClient::where('id', $id)->first();
        } else {
            $client_campaign = CampaignClient::where('id', $id)->where('relation_owner', $user)->where('marked_deleted', true)->first();
        }
        
        if($client_campaign){
            $query = $client_campaign->update(array(
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ));
            
            if($query){
                return Redirect::back()
                    ->with('success', '<strong>Congratulations!</strong> The Campaign-Client(Relation) is restored to the Client successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error,</strong> Relation Not Found, Either the client is not linked to that campaign or The URL Provided is invalid, please try again!');
        }
    }
    
}