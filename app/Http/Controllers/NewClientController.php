<?php

namespace App\Http\Controllers;

use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Unit,SubContact};
use Illuminate\Http\Request;

class NewClientController extends Controller
{
    /**
     * [addAction description]
     * @param [type] $id [description]
     */
    public function addAction($id)
    {
    	
    	$client = Client::find($id);
        $client->newly_assigned = $client->newly_assigned == 0 ? 1 : 0;
        $client->save();

        return back();
    }
    /**
     * [markRejectSeen description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function markRejectSeen(Request $request)
    {
        $prop = \App\Models\ClientProperty::find($request->id);
        $prop->update(['comment_seen'=>1]);

        return response()->json(['success'=>true]);
    }

    /**
     * [countNewLeads description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function countNewLeads(Request $request)
    {
        $new_count = auth()->user()->clientsAssigned()->where('newly_assigned', true)->where('marked_deleted', false)->where('is_customer', false)->count();
        $diff = $new_count - $request->num;

        if ($diff > 1) {
            return response()->json(['success'=> true,'diff'=>$diff,'new_count'=>$new_count]);
        } else {
            return response()->json(['success'=> false]);
        }
        
    }

}
