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


}
