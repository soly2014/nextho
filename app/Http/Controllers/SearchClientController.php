<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Unit,SubContact};
use Carbon\Carbon;
use PageTitle;
use DB;

class SearchClientController extends Controller
{
	/**
	 * [postSearch description]
	 * @param string $value [description]
	 */
    public function postSearch(Request $request)
    {
    	dd($request->all());
    }
}
