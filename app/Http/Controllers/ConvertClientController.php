<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Unit,SubContact,ParameterProject,SaleInfo};
use Carbon\Carbon;
use PageTitle;
use DB;

class ConvertClientController extends Controller
{
  
	 /**
	  * [FunctionName description]
	  * @param string $value [description]
	  */
	 public function show(Request $request,$id)
	 {
	 	return view('convert.convert',compact('id'));
	 }

	 /**
	  * [getDeveloperProjects description]
	  * @param  Request $request [description]
	  * @return [type]           [description]
	  */
	 public function getDeveloperProjects(Request $request)
	 {
	 	 $projects = ParameterProject::where('developer_id',$request->option)->get();
	 	 $list = '';
	 	 foreach ($projects as $project) {
	 	 	$list .= '<option value='.$project->id.'>'.$project->name.'</option>';
	 	 }

	 	 return $list;
	 }

     /**
      * [postConvert description]
      * @param  string $value [description]
      * @return [type]        [description]
      */
	 public function postConvert(Request $request,$id)
	 {
       


		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

// dd($request->all());

		if($client){
			
			$this->validate($request,[
									  'share' => 'required_with:shared_with|numeric',
									  'shared_with' => 'required_with:share',
									  'date' => 'required',
									  'unit_type' => 'required',
									  'area' => 'required|numeric',
									  'sold_price' => 'required|numeric',
									  'developer' => 'required_if:option,project',
									  'project' => 'required_if:option,project',
									  'client_type' => 'required_if:option,resale',
									  'location' => 'required_if:option,resale',
									  'street' => 'required',
									  'state' => 'required',
									  'country' => 'required',
									  'city' => 'required',
					        ]);



			// DB::transaction(function () use ($request,$client,$id)
			// {    
			          $first_agent_share = 100;
			          $first_agent_money = $request->sold_price;
					if ($request->shared_with != "") {

						$first_agent_share  = 100 - $request->share;
						$first_agent_money  = $request->sold_price * ($first_agent_share / 100);
						$second_agent_share = 100 - $first_agent_share;
						$second_agent_money = $request->sold_price - $first_agent_money;
					}



					$Today    = new Carbon($request->date.' 12:12:12');
					$purchase = ClientProperty::create([

						'unit_id'           => null,// static
						'propertable_type'  => $request->option == 'project' ? 'App\Models\Project' : 'App\Models\Unit',// static
						'propertable_id'    => $id,// static
						'created_by'        => auth()->user()->id,
						'price'             => $first_agent_money,
						'month'             => $Today->month,
						'year'              => $Today->year,
						'marked_deleted'    => false,
						'approved'          => false,
						'pending'           => true,
						'options'           => $request->option,
						'developer_id'      => $request->developer == "" ? null :$request->developer,
						'new_project_id'    => $request->project,
						'client_type'       => $request->client_type,
						'location'          => $request->location,
						'shared_with'       => auth()->user()->id,
						'shared_qty'        => $first_agent_share,
						'real_date'         => $Today
					]);


                    // update address
					$client->update([
						'street'                => $request->street,
						'state'                 => $request->state,
						'country'               => $request->country,
						'city'                  => $request->city,
						'zip_code'              => $request->zip_code,
						'pending_conversion'    => true
					]);




					$sale_info = SaleInfo::create(array(
						'transaction_id'    => $purchase->id,
						'unit_type'         => $request->unit_type,
						'unit_area'         => $request->area,
						'sold_price'        => $first_agent_money,
						'created_by'        => auth()->user()->id,
						'options'           => $request->option,
						'developer_id'      => $request->developer == "" ? null :$request->developer,
						'new_project_id'    => $request->project,
						'client_type'       => $request->client_type,
						'location'          => $request->location,
						'shared_with'       => auth()->user()->id,
  						'shared_qty'        => $first_agent_share,
						'real_date'         => $Today

					));


					if ($request->shared_with != "") {


						$purchase_two = ClientProperty::create([

									'unit_id'           => null,// static
            						'propertable_type'  => $request->option == 'project' ? 'App\Models\Project' : 'App\Models\Unit',// static
									'propertable_id'    => $id,// static
									'created_by'        => auth()->user()->id,
									'price'             => $second_agent_money,
									'month'             => $Today->month,
									'year'              => $Today->year,
									'marked_deleted'    => false,
									'approved'          => false,
									'pending'           => true,
									'options'           => $request->option,
									'developer_id'      => $request->developer == "" ? null :$request->developer,
									'new_project_id'    => $request->project,
									'client_type'       => $request->client_type,
									'location'          => $request->location,
									'shared_with'       => $request->shared_with,
									'shared_qty'        => $second_agent_share,
									'real_date'         => $Today,
									'related_to'        => $purchase->id
									]);


						$sale_info_two = SaleInfo::create([

									'transaction_id'    => $purchase_two->id,
									'unit_type'         => $request->unit_type,
									'unit_area'         => $request->area,
									'sold_price'        => $second_agent_money,
									'created_by'        => auth()->user()->id,
									'options'           => $request->option,
									'developer_id'      => $request->developer == "" ? null :$request->developer,
									'new_project_id'    => $request->project,
									'client_type'       => $request->client_type,
									'location'          => $request->location,
									'shared_with'       => $request->shared_with,
									'shared_qty'        => $second_agent_share,
									'real_date'         => $Today

						]);
						
					}




							if($sale_info){

								$status =  $client->update(array(
									'pending_conversion'    => true,
									'newly_assigned'        => false
								));
								if($status){
									if($client->is_customer == true){
											session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
										return redirect()->route('customers-view-single', array($client->id));
									}
										session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
									return redirect()->route('leads-view-single', array($client->id));
								}
							}



							if($purchase){

								if($client->is_customer == true){
										$request->session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
									return redirect()->route('customers-view-single', array($client->id));
								}

									$request->session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
								return redirect()->route('leads-view-single', array($client->id));
							}


			//});
			


		} else {
				$request->session()->flash('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.');
			return redirect()->route('leads-view');
		}


	 }







}
