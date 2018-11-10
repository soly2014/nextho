<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Unit,SubContact,ClientDeveloper,ClientProject};
use Carbon\Carbon;
use PageTitle;
use DB;

class ClientController extends Controller {

    /**
     * [getAll description]
     * @return [type] [description]
     */
	public function getAll()
	{

          //return $this->getPhones();

		$view_all = false;
		if(auth()->user()->userRole->view_all_leads){

			$leads 		= Client::with('userDeleted', 'userAssigned', 'district')->where('is_customer', false)
			                                                                     ->where('newly_assigned', false)
			                                                                     ->where('converted', false)
			                                                                     ->latest()->paginate(25);
			$no_leads 	= Client::with('userDeleted', 'userAssigned', 'district')->where('is_customer', false)
			                                                                     ->where('newly_assigned', true)
			                                                                     ->where('converted', false)
			                                                                     ->latest()->paginate(25);
			$converted 	= Client::with('userDeleted', 'userAssigned', 'district')->where('is_customer', false)
			                                                                     ->where('converted', true)
			                                                                     ->where('newly_assigned', false)
			                                                                     ->latest()->paginate(25);
			$view_all= true;
		} else { //if(auth()->user()->role_id == '2') {

			$leads 		= auth()->user()->clientsAssigned()->with('district')->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->where('converted', false)
			                                                                 ->latest()->paginate(25);
			$no_leads 	= auth()->user()->clientsAssigned()->with('district')->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('newly_assigned', true)
			                                                                 ->where('converted', false)
			                                                                 ->latest()->paginate(25);
			$converted 	= auth()->user()->clientsAssigned()->with('district')->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('converted', true)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->latest()->paginate(25);
		} // else {

		// 	$leads 		= auth()->user()->clientsAssigned()->with('district')->where('marked_deleted', false)
		// 	                                                                 ->where('is_customer', false)
		// 	                                                                 ->where('newly_assigned', false)
		// 	                                                                 ->where('converted', false)
		// 	                                                                 ->latest()->paginate(25);
		// 	$no_leads 	= Client::with('userDeleted', 'userAssigned', 'district')->where('marked_deleted', false)
		// 	                                                                     ->where('is_customer', false)
		// 	                                                                     ->where('newly_assigned', true)
		// 	                                                                     ->where('converted', false)
		// 	                                                                     ->latest()->paginate(25);
		// 	$converted 	= auth()->user()->clientsAssigned()->with('district')->where('marked_deleted', false)
		// 	                                                                 ->where('is_customer', false)
		// 	                                                                 ->where('converted', true)
		// 	                                                                 ->where('newly_assigned', false)
		// 	                                                                 ->latest()->paginate(25);

		// }

		PageTitle::add('View Leads');
		return view('clients.leadsview', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Leads',
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'View All',
					'crumb_link' => 'leads-view'
				])
			]),
			'leads'     		=> $leads,
			'converted'     	=> $converted,
			'noaction_leads'	=> $no_leads,
			'view_all'  		=> $view_all,
			'pag'			    => true
		));
	}

	/**
	 * [getPreCreate description]
	 * @return [type] [description]
	 */
	public function getPreCreate()
	{
		session(['number_type_mobile'=>'','number_type_international_number'=>'']);
		PageTitle::add('Create A New Lead');
		return view('clients.pre-create', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Leads',
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'Create Lead',
					'crumb_link' => 'leads-create'
				])
			])
		));
	}
	/**
	 * [postPreCreate description]
	 * @return [type] [description]
	 */
	public function postPreCreate(Request $request)
	{


		    $this->validate($request,[
		    	                      'phone'=> 'required_without:international_number|regex:/(01)[0-9]{9}/',
		    	                      'international_number'=> 'required_without:phone'
		    	                      ]);

		    if ($request->phone != '' && $request->international_number != '') {
                session()->flash('warn', ('<strong>Error</strong> please add one value '));
                return back();
		    }

		    $number = $request->phone != '' ? $request->phone : $request->international_number;


		    $isPresented = in_array($number,$this->getPhones());            


			$lead = Client::where('Phone', $number)->orWhere('mobile', $number)->orWhere('mobile_two', $number)->orWhere('international_number', $number)->orWhereHas('sub',function ($query)use($number)
								{
									$query->where('phone', $number)->orWhere('mobile_one', $number)->orWhere('mobile_two', $number)->orWhere('international_number', $number);
								})->first();

			$user = auth()->user()->id;


			if(!$lead){

				$number_type_mobile = $request->phone != '' ? $number : '';
				$number_type_international_number = $request->phone == '' ? $number : '';

				session(['number_type_mobile'=>$number_type_mobile,'number_type_international_number'=>$number_type_international_number]);

				return redirect()->route('leads-create-get')->with('valide', true);

			} else if($lead->assigned_to != $user){

                session()->flash('warn', ('<strong>Lead Already Exists</strong> the phone number entered is already asociated with a Client that is Assigned To '.$lead->userAssigned->username));
				return redirect()->route('leads-activity-get', array($lead->id))->with('valide', false);

			} else {

				if($lead->is_customer){
                    
                    session()->flash('warn', ('<strong>Customer Already Exists</strong> the phone number entered is already asociated with a Customer that is Assigned To you'));
					return redirect()->route('customers-view-single', array($lead->id));
				} else {
                   
                   session()->flash('warn', ('<strong>Lead Already Exists</strong> the phone number entered is already asociated with a Lead that is Assigned To you'));					
					return redirect()->route('leads-view-single', array($lead->id));
				}
			}

	}
	/**
	 * [getExist description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getExist($id){

		$client = Client::where('id', $id)->where('marked_deleted', false)->first();
		if($client){
			PageTitle::add('Create A New Lead');
			return view('clients.leave-activity', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Leads',
						'crumb_link' => ''
					])
					,array([
						'crumb_name' => 'Create Lead',
						'crumb_link' => 'leads-create'
					])
				]),
				'object'        => $client,
				'model_type'    => 'Client'
			));
		} else {

			session()->flash('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists or the provided URL is Invalid.');
			return route('leads-view');
		}
	}







	/**
	 * [getCreate description]
	 * @return [type] [description]
	 */
	public function getCreate()
	{
		$valide = \Session::get('valide');
		$mobile = \Session::get('mobile');
		$initially_assign = false;
		if(auth()->user()->userRole->initially_assign_leads){
			$initially_assign = true;
		}
		//if($valide){
			$lead_source = ClientSource::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id');
			$lead_status = ClientStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id');
			$title = [
				"0"         => "-None-",
				"Mr."       => "Mr.",
				"Mrs."      => "Mrs.",
				"Ms."       => "Ms.",
				"Eng."	    => "Eng.",
				"Dr."       => "Dr."
			];
			PageTitle::add('Create A New Lead');
			return view('clients.create', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Leads',
						'crumb_link' => ''
					])
					,array([
						'crumb_name' => 'Create Lead',
						'crumb_link' => 'leads-create'
					])
				]),
				'title'             => $title,
				'lead_source'       => $lead_source,
				'lead_status'       => $lead_status,
				'initially_assign'  => $initially_assign,
				'mobile'            => $mobile
			));

		// } else {
		// 	return redirect()->route('leads-create');
		// }
	}





	/**
	 * [postCreate description]
	 * @return [type] [description]
	 */
	public function postCreate(Request $request){


		PageTitle::add('Create A New Lead');

		$messages = ['required_if' => 'You have to choose a User to assign the lead to.'];
		$select = '1';

		$this->validate($request,
							 array(
								 'name'                  => 'required|regex:/^[a-zA-Z ]+$/u',
								 'last_name'             => 'regex:/^[a-zA-Z ]+$/u',
								 'company'               => 'regex:/^[a-zA-Z ]+$/u',
								 'work_title'            => 'regex:/^[a-zA-Z ]+$/u',
								 'phone'                 => 'required_without_all:mobile,mobile_two,international_number|regex:/[0-9]/',
								 'mobile_two'            => 'required_without_all:mobile,phone,international_number|regex:/(01)[0-9]{9}/',
								 'international_number'  => 'required_without_all:mobile,mobile_two,phone',
								 'mobile'                => 'required_without_all:phone,international_number,mobile_two|regex:/(01)[0-9]{9}/',
								 'description'           => 'required|max:5120',
								 'secondary_email'       =>  $request->secondary_email ? 'email': '',
								 'email'                 =>  $request->email ? 'email': '',
								 'assign_to'             => 'required_if:assign_leads,1',
								 'cat'		    	     => 'required|not_in:'.$select,
								 'lead_source'		     => 'required|not_in:'.'17',
								 'lead_status'		     => 'required|not_in:'.'9',
								 'interested_district'	 => 'required|not_in:'.$select,
								 'interested_type'    	 => 'required|not_in:'.'10',
								 'developer_id'          => 'required',
								 'project_id'            => 'required',
								 'new_mobile_one'        => $request->new_mobile_one ? 'regex:/(01)[0-9]{9}/' : '',
								 'new_mobile_two'        => $request->new_mobile_two ? 'regex:/(01)[0-9]{9}/' : '',
								 'new_email'             => $request->new_email ? 'email' : '',
								 'new_first_name'        => $request->new_first_name ? 'regex:/^[a-zA-Z ]+$/u' : '',
								 'new_last_name'         => $request->new_last_name ? 'regex:/^[a-zA-Z ]+$/u' : ''

							 ), $messages
						);
        // 
				if (
			    	    in_array($request->phone , $this->getPhones()) || 
			    	    in_array($request->mobile , $this->getPhones()) || 
			    	    in_array($request->mobile_two , $this->getPhones()) || 
			    	    in_array($request->international_number , $this->getPhones()) || 
			    	    in_array($request->new_phone , $this->getPhones()) ||
			    	    in_array($request->new_mobile_one , $this->getPhones()) || 
			    	    in_array($request->new_mobie_two , $this->getPhones()) || 
			    	    in_array($request->new_international_number , $this->getPhones()) 
		       ){
			    	    // session()->flash('error', '<div class="alert alert-danger"><strong>Error!</strong> This phone number already exists.</div>');
			            return response()->json(['success'=>false,'message'=>'<div class="alert alert-danger"><strong>Error!</strong> This phone number already exists.</div>']);

		        }

			    if (
				    	    in_array($request->email , $this->getEmails()) || 
				    	    in_array($request->secondary_email , $this->getEmails()) || 
				    	    in_array($request->new_email, $this->getEmails())
			     ){

				    	    // session()->flash('error', '<div class="alert alert-danger"><strong>Error!</strong> This Email  already exists.</div>');
				            return response()->json(['success'=>false,'message'=>'<div class="alert alert-danger"><strong>Error!</strong> This Email  already exists.</div>']);

			     }


        // 
		DB::transaction(function()use($request){
 

				$name                   = $request->name;
				$title                  = $request->title;
				$company                = $request->company ? : '';
				$work_title             = $request->work_title ? : '';
				$phone                  = $request->phone ? : '';
				$mobile                 = $request->mobile ? : '';
				$email                  = $request->email ? : '';
				$opt_out                = $request->opt_out ? true : false;
				$last_name              = $request->last_name ? : '';
				$fax                    = $request->fax ? : '';
				$lead_status            = $request->lead_status;
				$lead_source            = $request->lead_source;
				$secondary_email        = $request->secondary_email ? : '';
				$street                 = $request->street ? : '';
				$state                  = $request->state ? : '';
				$country                = $request->country ? : '';
				$city                   = $request->city ? : '';
				$zip_code               = $request->zip_code ? : '';
				$description            = $request->description;
				$interested_district    = $request->interested_district;
				$interested_type        = $request->interested_type;
				//MY EDIT
				$cat					= $request->cat;

				$created_by = auth()->user()->id;
				$newly_assigned = false;
				if($request->assign_to != ''){
					$user               = $request->assign_to;
					$newly_assigned     = true;
				} else {
					$user               = $created_by;
				}


  
				$lead = Client::create(array(
					'name'              => $name,
					'title'             => $title,
					'company'           => $company,
					'work_title'        => $work_title,
					'phone'             => $phone,
					'mobile'            => $mobile,
					'mobile_two'             => $request->mobile_two,
					'international_number'   => $request->international_number,
					'badget_from'            => $request->from,
					'badget_to'              => $request->to,
					'email'             => $email,
					'opt_out'           => $opt_out,
					'last_name'         => $last_name,
					'fax'               => $fax,
					'client_status_id'  => $lead_status,
					'client_source_id'  => $lead_source,
					'secondary_email'   => $secondary_email,
					'interested_type'   => $interested_type,
					'interested_district' =>$interested_district,
					'street'            => $street,
					'state'             => $state,
					'country'           => $country,
					'city'              => $city,
					'zip_code'          => $zip_code,
					'description'       => $description,
					'marked_deleted'    => false,
					'is_customer'       => false,
					'newly_assigned'   => $newly_assigned,
					'created_by'        => $created_by,
					'assigned_to'       => $user,
					'last_updated_by'   => $created_by,
					//MY EDIT
					'cat'				=> $cat
				));


				$Assign_History = ClientUser::create(array(
					'client_id'         => $lead->id,
					'user_id'           => $user,
					'created_by'        => $user,
					'marked_deleted'    => false
				));


				SubContact::create([

					  'title'                 => $request->new_title,
					  'first_name'            => $request->new_first_name,
					  'last_name'             => $request->new_last_name,
					  'phone'                 => $request->new_phone,
					  'mobile_one'            => $request->new_mobile_one,
					  'mobile_two'            => $request->new_mobie_two,
					  'international_number'  => $request->new_international_number,
					  'email'                 => $request->new_email,
					  'user_id'               => $lead->id,
				]);

                if ($request->developer_id) {
		            $lead->developers()->attach($request->developer_id);
                }

                if ($request->project_id) {
		            $lead->projects()->attach($request->project_id);
                }
        });	


		 return response()->json(['success'=>true,'message'=>'<div class="alert alert-success"><strong>Error!</strong> This Lead Added Successfully.</div>']);

	}
	/*
     * End Create Methods
     */











	/*
     * Get Single Lead
     */
	public function getSingle($id){


		$view_all = false;
		if(auth()->user()->userRole->view_all_leads){
			$client = Client::where('id', $id)->where('is_customer', 0)->first();
			$view_all = true;
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->where('is_customer', 0)->first();
		}

		if($client){

			$user = auth()->user()->id;
			$view_notes = auth()->user()->userRole->view_any_lead_note;
			$view_activities = auth()->user()->userRole->view_any_lead_activities;
			$view_emails = auth()->user()->userRole->view_any_lead_emails;
			$view_attachments = auth()->user()->userRole->view_any_lead_attachments;
			$view_campaigns = auth()->user()->userRole->view_any_lead_campaigns;


			if(($client->show_notes) || $view_notes){
				if($view_notes){
					$notes = $client->notes()->get()->load('userDeleted');
				} else {
					$notes = $client->notes()->where('marked_deleted', 0)->where('note_owner', $user)->get()->load('userDeleted');
				}
			} else {
				$notes = $client->notes()->where('marked_deleted', 0)->where('created_by', $user)->get();
			}



			if(($client->show_all_activities) || $view_activities){
				if($view_activities){
					$open_activities = $client->activities()->whereNotIn('status', [4])->get()->load('userDeleted');
					$closed_activities = $client->activities()->where('status', 4)->get()->load('userDeleted');
				} else {
					$open_activities = $client->activities()->where('marked_deleted', 0)->whereNotIn('status', [4])->get();
					$closed_activities = $client->activities()->where('marked_deleted', 0)->where('status', 4)->get();
				}

			} else {
				$open_activities = $client->activities()->where('marked_deleted', 0)->where('created_by', $user)->whereNotIn('status', [4])->get();
				$closed_activities = $client->activities()->where('marked_deleted', 0)->where('created_by', $user)->where('status', 4)->get();
			}



			if(($client->show_all_attachements) || $view_attachments){
				if($view_attachments){
					$attachments = $client->attachments()->get()->load('userDeleted');
				} else {
					$attachments = $client->attachments()->where('marked_deleted', 0)->get()->load('userDeleted');
				}
			} else {
				$attachments = $client->attachments()->where('marked_deleted', 0)->where('attached_by', $user)->get()->load('userDeleted');
			}



			if(($client->show_all_campaigns) || $view_campaigns){
				if($view_campaigns){
					$campaigns = $client->campaigns()->get();
				} else {
					$campaigns = $client->campaigns()->wherePivot('marked_deleted', 0)->get();
				}
			} else {
				$campaigns = $client->campaigns()->wherePivot('marked_deleted', 0)->wherePivot('added_by', $user)->get();
			}



			if(($client->show_all_emails) || $view_emails){
				$email_templates = $client->emails()->wherePivot('marked_deleted', 0)->get();
			} else {
				$email_templates = $client->emails()->wherePivot('marked_deleted', 0)->wherePivot('sent_by', $user)->get();
			}


			$delete_action = false;
			if((($client->assigned_to == $user) && auth()->user()->userRole->delete_lead_info)){
				$delete_action = true;
			} else if(auth()->user()->userRole->delete_any_lead){
				$delete_action = true;
			}


			$add_notes      = auth()->user()->userRole->add_lead_note;
			$add_attachment = auth()->user()->userRole->add_lead_attachment;
			$add_activity   = auth()->user()->userRole->add_lead_activity;
			$add_campaign   = auth()->user()->userRole->add_lead_campaign;

			PageTitle::add('View Lead Details');
			return view('clients.singleview', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Leads',
						'crumb_link' => ''
					])
					,array([
						'crumb_name' => 'View All',
						'crumb_link' => 'leads-view'
					])
				]),
				'object'                => $client,
				'notes'                 => $notes,
				'open_activities'       => $open_activities,
				'completed_activities'  => $closed_activities,
				'attachments'           => $attachments,
				'campaigns'             => $campaigns,
				'emails'                => $email_templates,
				'add_note'              => $add_notes,
				'add_attachment'        => $add_attachment,
				'add_activity'          => $add_activity,
				'add_campaign'          => $add_campaign,
				'delete_action'         => $delete_action,
				'view_all'              => $view_all,
				'model_type'            => 'Client',
				'customer'              => false
			));
		} else {

				session()->flash('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists or is no longer Assigned to you.');
			return redirect()->route('leads-view');
		}
	}
	/*
     * End Get Single Lead
     */

	/*
     * Modify Methods
     */
	public function getModify($id)
	{
		if(auth()->user()->userRole->modify_all_leads){
			$client = Client::where('id', $id)->first();
			if($client->is_customer){
				if(!auth()->user()->userRole->modify_all_customers){
						session()->flash('error', '<strong>Error!</strong> You don\'t have the sufficient privileges to Access the intended URL!');
					return redirect()->route('customers-view');
				}
			}
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

		if($client){
			$lead_source = ClientSource::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id');
			$lead_status = ClientStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id');
			$title = [
				"0"         => "-None-",
				"Mr."       => "Mr.",
				"Mrs."      => "Mrs.",
				"Ms."       => "Ms.",
				"Eng."	    => "Eng.",
				"Dr."       => "Dr."
			];

		// dd('skmlks');
			PageTitle::add('Modify A Lead\'s Info');
			return view('clients.edit', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Leads',
						'crumb_link' => ''
					])
					,array([
						'crumb_name' => 'Edit Lead',
						'crumb_link' => 'leads-modify-single'
					])
				]),
				'client' => $client,
				'customer' => false,
				'title'         => $title,
				'lead_source'   => $lead_source,
				'lead_status'   => $lead_status,
			));
		} else {
				 session()->flash('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists or is no longer Assigned to you.');
			return redirect()->route('leads-view');
		}
	}









    /**
     * [postModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function postModify(Request $request,$id){


		if(auth()->user()->userRole->modify_all_leads){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}


		PageTitle::add('Create A New Lead');

		$messages = ['required_if' => 'You have to choose a User to assign the lead to.'];
		$select = '1';

		$this->validate($request,
							 array(
								 'name'                  => 'required|regex:/^[a-zA-Z ]+$/u',
								 'work_title'            => 'regex:/^[a-zA-Z ]+$/u',
								 'country'               => 'regex:/^[a-zA-Z ]+$/u',
								 'last_name'             => 'regex:/^[a-zA-Z ]+$/u',
								 'company'               => 'regex:/^[a-zA-Z ]+$/u',								 
								 'phone'                 => 'required_without_all:mobile,mobile_two,international_number',
								 'mobile_two'            => 'required_without_all:mobile,phone,international_number|regex:/(01)[0-9]{9}/',
								 'international_number'  => 'required_without_all:mobile,mobile_two,phone',
								 'mobile'                => 'required_without_all:phone,international_number,mobile_two|regex:/(01)[0-9]{9}/',
								 'description'           => auth()->user()->role_id != '2' ? 'required|max:5120' : '',
								 'secondary_email'       => $request->secondary_email ? 'email': '',
								 'email'                 => $request->email ? 'email': '',
								 'assign_to'             => 'required_if:assign_leads,1',
								 'cat'		    	     => 'required|not_in:'.$select,
								 'lead_status'		     => 'required|not_in:'.'9',
								 'interested_district'	=> 'required|not_in:'.$select,
								 'interested_type'	    => 'required|not_in:'.'10',
								 'developer_id'         => 'required',
								 'project_id'           => 'required',								 
								 'new_mobile_one'       => $request->new_mobile_one ? 'regex:/(01)[0-9]{9}/' : '',
								 'new_mobile_two'       => $request->new_mobile_two ? 'regex:/(01)[0-9]{9}/' : '',
								 'new_email'             => $request->new_email ? 'email' : '',
								 'new_first_name'        => $request->new_first_name ? 'regex:/^[a-zA-Z ]+$/u' : '',
								 'new_last_name'         => $request->new_last_name ? 'regex:/^[a-zA-Z ]+$/u' : ''
							 
							 ), $messages
							);

            $old_phones = [];

			if (
		    	    in_array($request->phone , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->mobile , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->mobile_two , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->international_number , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->new_phone , $this->getPhonesForUpdate($id)) ||
		    	    in_array($request->new_mobile_one , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->new_mobie_two , $this->getPhonesForUpdate($id)) || 
		    	    in_array($request->new_international_number , $this->getPhonesForUpdate($id)) 
	       ){
		    	    // session()->flash('error', '<div class="alert alert-danger"><strong>Error!</strong> This phone number already exists.</div>');
		            return response()->json(['success'=>false,'message'=>'<div class="alert alert-danger"><strong>Error!</strong> This phone number already exists.</div>']);

	        }

		    if (
			    	    in_array($request->email , $this->getEmailsForUpdate($id)) || 
			    	    in_array($request->secondary_email , $this->getEmailsForUpdate($id)) || 
			    	    in_array($request->new_email, $this->getEmailsForUpdate($id))
		     ){

			    	    // session()->flash('error', '<div class="alert alert-danger"><strong>Error!</strong> This Email  already exists.</div>');
			            return response()->json(['success'=>false,'message'=>'<div class="alert alert-danger"><strong>Error!</strong> This Email  already exists.</div>']);

		     }

        // 
		DB::transaction(function()use($request,$client){
 

				$name                   = $request->name;
				$title                  = $request->title;
				$company                = $request->company ? : '';
				$work_title             = $request->work_title ? : '';
				$phone                  = $request->phone ? : '';
				$mobile                 = $request->mobile ? : '';
				$email                  = $request->email ? : '';
				$opt_out                = $request->opt_out ? true : false;
				$last_name              = $request->last_name ? : '';
				$fax                    = $request->fax ? : '';
				$lead_status            = $request->lead_status;
				$secondary_email        = $request->secondary_email ? : '';
				$street                 = $request->street ? : '';
				$state                  = $request->state ? : '';
				$country                = $request->country ? : '';
				$city                   = $request->city ? : '';
				$zip_code               = $request->zip_code ? : '';
				$description            = auth()->user()->role_id == '2' ? $client->description : $request->description;
				$interested_district    = $request->interested_district;
				$interested_type        = $request->interested_type;
				//MY EDIT
				$cat					= $request->cat;

				$created_by = auth()->user()->id;
  
				$client->update([ 
					'name'              => $name,
					'title'             => $title,
					'company'           => $company,
					'work_title'        => $work_title,
					'phone'             => $phone,
					'mobile'            => $mobile,
					'mobile_two'             => $request->mobile_two,
					'international_number'   => $request->international_number,
					'badget_from'            => $request->from,
					'badget_to'              => $request->to,
					'email'             => $email,
					'opt_out'           => $opt_out,
					'last_name'         => $last_name,
					'fax'               => $fax,
					'client_status_id'  => $lead_status,
					'secondary_email'   => $secondary_email,
					'interested_type'   => $interested_type,
					'interested_district' =>$interested_district,
					'street'            => $street,
					'state'             => $state,
					'country'           => $country,
					'city'              => $city,
					'zip_code'          => $zip_code,
					'description'       => $description,
					'assigned_to'       => $request->assign_to ? $request->assign_to : $client->assigned_to,
					'last_updated_by'   => $created_by,
					//MY EDIT
					'cat'				=> $cat
				]);

				if ($client->sub()->first()) {
					$client->sub()->first()->update([

						  'title'                => $request->new_title,
						  'first_name'           => $request->new_first_name,
						  'last_name'            => $request->new_last_name,
						  'phone'                => $request->new_phone,
						  'mobile_one'           => $request->new_mobile_one,
						  'mobile_two'           => $request->new_mobie_two,
						  'international_number' => $request->new_international_number,
						  'email'                => $request->new_email,
					]);
				} else {
					$client->sub()->create([

						  'title'                => $request->new_title,
						  'first_name'           => $request->new_first_name,
						  'last_name'            => $request->new_last_name,
						  'phone'                => $request->new_phone,
						  'mobile_one'           => $request->new_mobile_one,
						  'mobile_two'           => $request->new_mobie_two,
						  'international_number' => $request->new_international_number,
						  'email'                => $request->new_email,
					]);
				}
				


				// delete old developers & projects
                $client->developers()->sync($request->developer_id);
                $client->projects()->sync($request->project_id);
                
        });	


		 return response()->json(['success'=>true,'message'=>'<div class="alert alert-success"><strong>Error!</strong> This Lead Updated Successfully.</div>']);
		
	}
	/*
     * End Modify Methods
     */

	public function getSendEmail($id){

		if(auth()->user()->userRole->email_all_leads){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

		$emails = EmailTemplate::where('marked_deleted', false)
			->where('published', true)
			->where(function($query)
					{
						$query->where('expiry_date', '>', date('y-m-d'))
							->orWhere('expiry_date', NULL);
					})
			->get();

		if($client) {
			PageTitle::add('Send Email Template');
			return view('clients.sendemail', array(
				'email_templates'   => $emails,
				'client'            => $client
			));
		} else {
			return Redirect::back()
				->with('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists, is no longer Assigned to you or the URL Provided is invalid.');
		}
	}

	public function postSendEmail($id){

		if(auth()->user()->userRole->email_all_leads){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

		if($client) {
			$validator = $this->validate($request,
										 array(
											 'selected_template'    => 'required'
										 )
										);

			if($validator->fails()) {
				return Redirect::back()
					->withErrors($validator);
			} else {
				$selected_template  = (int)Input::get('selected_template');

				$email_template = EmailTemplate::where('id', $selected_template)->where('marked_deleted', false)
					->where('published', true)
					->where(function($query)
							{
								$query->where('expiry_date', '>', date('y-m-d'))
									->orWhere('expiry_date', NULL);
							})
					->first();

				$email_sent = ($email_template->sent_number + 1);
				$query = $email_template->update(array(
					'sent_number' => $email_sent
				));

				$sent_date      = date("Y-m-d H:i:s");
				$user           = auth()->user()->id;
				if(Input::get('email_title') != "") {
					$mail_subject = Input::get('email_title');
				} else {
					$mail_subject = $email_template->email_title;
				}

				$addEmailRecord = ClientEmail::create(array(
					'email_subject'     => $mail_subject,
					'client_id'         => $client->id,
					'email_template_id' => $email_template->id,
					'sent_by'           => $user,
					'sent_date'         => $sent_date
				));

				if($addEmailRecord){
					Mail::send('emails.templates.project', array("email" => $email_template), function($message) use ($email_template, $client, $mail_subject){
						$message->to(auth()->user()->email, "Be CRM")->subject($mail_subject)
							->replyTo(auth()->user()->email, auth()->user()->username);
						foreach($email_template->attachments as $file){
							$message->attach($file->filepath);
						}
					});
					return Redirect::back()
						->with('success', '<strong>Congratulations!</strong> The Email was sent Successfully to the Client "'.$client->name.'".');
				} else {
					return Redirect::back()
						->with('error', '<strong>Error!</strong> It Appears that the Email Template either no longer exists or the URL Provided is invalid.');
				}

			}
		} else {
			return Redirect::back()
				->with('error', '<strong>Error!</strong> It Appears that the Client you are looking for either no longer exists, is no longer Assigned to you or the URL Provided is invalid.');
		}
	}

	/*
     * Customer Functions
     */
	public function getAllCustomers()
	{

		$view_all = false;
		if(auth()->user()->userRole->view_all_customers){
			$client = Client::with('propertiesCount', 'propertiesAmount', 'userAssigned', 'userDeleted')->where('is_customer', true)->get();
			$view_all= true;
		} else {
			$client = auth()->user()->clientsAssigned()->where('marked_deleted', 0)->where('is_customer', 1)->get()->load('propertiesCount', 'propertiesAmount');
		}

		PageTitle::add('View Customers');
		return view('clients.customersview', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Customer',
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'View All',
					'crumb_link' => 'customers-view'
				])
			]),
			'clients'   => $client,
			'view_all'  => $view_all
		));
	}









	/**
	 * [getSingleCustomer description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getSingleCustomer($id)
	{

		$view_all = false;
		if(auth()->user()->userRole->view_all_customers){
			$client = Client::where('id', $id)->where('is_customer', true)->first();
			$view_all = true;
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->where('is_customer', 1)->first();
		}

		if($client){

			$view_notes = auth()->user()->userRole->view_any_customer_note;
			$view_activities = auth()->user()->userRole->view_any_customer_activities;
			$view_emails = auth()->user()->userRole->view_any_customer_emails;
			$view_attachments = auth()->user()->userRole->view_any_customer_attachments;
			$view_campaigns = auth()->user()->userRole->view_any_customer_campaigns;

			//dd($view_notes);
			//return Response::json($client->toJson());
			$user = auth()->user()->id;
			if(($client->show_notes) || $view_notes){
				if($view_notes){
					$notes = $client->notes()->get()->load('userDeleted');
				} else {
					$notes = $client->notes()->where('marked_deleted', 0)->where('note_owner', $user)->get()->load('userDeleted');
				}

			} else {
				$notes = $client->notes()->where('marked_deleted', 0)->where('note_owner', $user)->get();
			}
			if(($client->show_all_activities) || $view_activities){
				if($view_activities){
					$open_activities = $client->activities()->whereNotIn('status', [4])->get();
					$closed_activities = $client->activities()->where('status', 4)->get();
				} else {
					$open_activities = $client->activities()->where('marked_deleted', 0)->whereNotIn('status', [4])->get();
					$closed_activities = $client->activities()->where('marked_deleted', 0)->where('status', 4)->get();
				}

			} else {
				$open_activities = $client->activities()->where('marked_deleted', 0)->where('created_by', $user)->whereNotIn('status', [4])->get();
				$closed_activities = $client->activities()->where('marked_deleted', 0)->where('created_by', $user)->where('status', 4)->get();
			}
			if(($client->show_all_attachements) || $view_attachments){
				if($view_attachments){
					$attachments = $client->attachments()->get()->load('userDeleted');
				} else {
					$attachments = $client->attachments()->where('marked_deleted', 0)->get()->load('userDeleted');
				}
			} else {
				$attachments = $client->attachments()->where('marked_deleted', 0)->where('attachment_owner', $user)->get();
			}
			if(($client->show_all_campaigns) || $view_campaigns){
				if($view_campaigns){
					$campaigns = $client->campaigns()->get();
				} else {
					$campaigns = $client->campaigns()->wherePivot('relation_owner', $user)->wherePivot('marked_deleted', 0)->get();
				}
			} else {
				$campaigns = $client->campaigns()->wherePivot('marked_deleted', 0)->wherePivot('added_by', $user)->get();
			}
			if(($client->show_all_emails) || $view_emails){
				$email_templates = $client->emails()->wherePivot('marked_deleted', 0)->get();
			} else {
				$email_templates = $client->emails()->wherePivot('marked_deleted', 0)->wherePivot('sent_by', $user)->get();
			}

			$delete_action = false;
			if((($client->assigned_to == $user) && auth()->user()->userRole->delete_customer_info)){
				$delete_action = true;
			} else if(auth()->user()->userRole->delete_any_customer){
				$delete_action = true;
			}

			$add_notes      = auth()->user()->userRole->add_customer_note;
			$add_attachment = auth()->user()->userRole->add_customer_attachment;
			$add_activity   = auth()->user()->userRole->add_customer_activity;
			$add_campaign   = auth()->user()->userRole->add_customer_campaign;


			PageTitle::add('View "'.$client->name.'" Details');
			return view('clients.singleview', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Customer',
						'crumb_link' => ''
					])
					,array([
						'crumb_name' => 'View All',
						'crumb_link' => 'customers-view-single'
					])
				]),
				'object'                => $client,
				'notes'                 => $notes,
				'open_activities'       => $open_activities,
				'completed_activities'  => $closed_activities,
				'attachments'           => $attachments,
				'campaigns'             => $campaigns,
				'emails'                => $email_templates,
				'add_note'              => $add_notes,
				'add_attachment'        => $add_attachment,
				'add_activity'          => $add_activity,
				'add_campaign'          => $add_campaign,
				'view_all'              => $view_all,
				'delete_action'         => $delete_action,
				'properties'            => $client->Properties()->where('marked_deleted', 0)->where('approved', true)->where('pending', false)->get()->load('Unit', 'Project', 'projectUnit', 'userCreated'),
				'model_type'            => 'Client',
				'customer'              => true
			));

		} else {
				   session()->flash('error', '<strong>Error!</strong> It Appears that the Customer you are looking for either no longer exists or is no longer Assigned to you.');
			return redirect()->route('customers-view');
		}

	}





	
	/**
	 * [getModifyCustomer description]
	 * @return [type] [description]
	 */
	public function getModifyCustomer()
	{
		PageTitle::add('Modify A Customers\'s Info');
		return view('clients.edit', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Customers',
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'Edit Customer',
					'crumb_link' => 'customers-modify-single'
				])
			])
		));
	}




    /**
     * [postDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function postDelete($id){

		$check = Client::where('id', $id)->first();

		if($check->is_customer){
			if(auth()->user()->userRole->delete_any_customer){
				$client = $check;
			} else {
				$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
			}
		} else {
			if(auth()->user()->userRole->delete_any_lead){
				$client = $check;
			} else {
				$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
			}
		}


		if($client){

			$now_dt = date('Y-m-d H:i:s');
			$user = auth()->user()->id;
			$op = $client->update(array(
				'marked_deleted'    => true,
				'deleted_at'        => $now_dt,
				'deleted_by'        => $user
			));

			if($op){
				if($client->is_customer){
						   session()->flash('success', '<strong>Congratulations!</strong> The Customer "'.$client->name.'" is deleted successfully.');
					return redirect()->route('customers-view');
				} else {
						   session()->flash('success', '<strong>Congratulations!</strong> The Lead "'.$client->name.'" is deleted successfully.');
					return redirect()->route('leads-view');
				}
			}
		} else {
				   session()->flash('error', '<strong>Error!</strong> The Intended Lead/Customer is not assigned to you, is already deleted or the provided URL is invalid');
			return back();
		}

	}



	/**
	 * [postRestore description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function postRestore($id){

		$check = Client::where('id', $id)->first();

		if($check->is_customer){
			if(auth()->user()->userRole->restore_any_customer){
				$client = $check;
			} else {
				$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', true)->first();
			}
		} else {
			if(auth()->user()->userRole->restore_any_lead){
				$client = $check;
			} else {
				$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', true)->first();
			}
		}

		if($client){

			$op = $client->update(array(
				'marked_deleted'    => false,
				'deleted_at'        => null,
				'deleted_by'        => null
			));

			if($op){
				if($client->is_customer){
						session()->flash('success', '<strong>Congratulations!</strong> The Customer "'.$client->name.'" is Restored successfully.');
					return redirect()->route('customers-view-single', array($client->id));
				} else {
						session()->flash('success', '<strong>Congratulations!</strong> The Lead "'.$client->name.'" is Restored successfully.');
					return redirect()->route('leads-view-single', array($client->id));
				}
			}
		} else {
				session()->flash('error', '<strong>Error!</strong> The Intended Lead/Customer is not assigned to you, is not deleted or the provided URL is invalid');
			return back();
		}

	}

	/*
     * Convert Lead To Customer
     */
	public function getPreConvert($id){

		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

		if($client){
			if($client->pending_conversion == false){
				PageTitle::add('Convert The Lead '.$client->name);
				return view('clients.pre-convert', array(
					'breadcrumbs' => array([
						array([
							'crumb_name' => 'Leads',
							'crumb_link' => 'leads-view'
						])
						,array([
							'crumb_name' => $client->name,
							'crumb_link' => ''
						])
						,array([
							'crumb_name' => 'Convert Lead',
							'crumb_link' => ''
						])
					]),
					'lead'  => $client
				));
			} else {
				//dd($id);
				$is_customer = $client->is_customer;
				if($is_customer){
						session()->flash('info', '<strong>Note!</strong> Kindly Be Informed that the selected Customer Already have a Pending Sale Action, you cannot add a New Sale untill the pending action is resolved.');
					return route('customers-view-single', array($id));
				}
					session()->flash('info', '<strong>Note!</strong> Kindly Be Informed that the selected lead is still Pending Conversion, you cannot re-Convert the lead untill the pending action is resolved.');
				return route('leads-view-single', array($id));
			}
		} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.');
			return route('leads-view');
		}
	}

	/**
	 * [postPreConvert description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function postPreConvert(Request $request,$id){

		$submit = $request->submit;// Unit Or Project

		return redirect()->route('leads-convert', array($id))->with('type', $submit);
	}


	/**
	 * [getConvert description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getConvert(Request $request,$id){

		$type = \Session::get('type');

		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}

		if($client){
			$breadcrumb = array([
				array([
					'crumb_name' => 'Leads',
					'crumb_link' => 'leads-view'
				])
				,array([
					'crumb_name' => $client->name,
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'Convert Lead',
					'crumb_link' => ''
				])
			]);

			PageTitle::add('Add A Property To "'.$client->name.'"');
			$convert_type;
			$units = Null;
			

			if($type == "Unit"){
				$convert_type = "clients.convert-unit";
				$units = Unit::where('marked_deleted', false)->where('on_hold', false)->where('sold', false)->get();
			} else if($type == "Project") {
				$convert_type = "clients.convert-project";
				$units = Project::where('marked_deleted', false)->where('available', true)->get();
			}

			if($units == Null){
					$request->session()->flash('error', '<strong>Error!</strong> It Appears that the Category you choose doesn\'t contain any properties, make sure that there\'s a unit/project that fits your criteria and try again.');
				return redirect()->route('leads-view');
			}
			//dd($convert_type);
			return view($convert_type, array(
				'breadcrumbs'   => $breadcrumb,
				'valid'         => true,
				'lead'          => $client,
				'type'          => $type,
				'units'         => $units
			));
		} else {
				$request->session()->flash('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.');
			return redirect()->route('leads-view');
		}
	}




    /**
     * [postConvert description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function postConvert(Request $request,$id){


		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}


		$messages = array(
			'required_if' => 'The Address info is Required.',
		);


		if($client){
			$validator = $this->validate($request,
										 array(
											 'property_type'    => 'required',
											 'selected_unit'    => 'required_if:property_type,Unit',
											 'price'            => 'required_if:property_type,Unit',
											 'city'             => 'required_if:address_info,1',
											 'country'          => 'required_if:address_info,1',
											 'street'           => 'required_if:address_info,1'
										 ), $messages
										);


				$type           = $request->property_type;
				$sold_price     = $request->price;
				$user           = auth()->user()->id;

				if($type == "Unit"){
					$selected_unit  = (int)$request->selected_unit;
					$unit = Unit::where('id', $selected_unit)->first();

					if($unit){
						$unit->update(array(
							'on_hold'   => true
						));
					} else {
						return route('leads-view-single', array($id))
							->with('error', '<strong>Error!</strong> It Appears that the Unit intended either no longer exists or the provided URL is Invalid.');
					}

					
					$Today    = Carbon::today();
					$purchase = ClientProperty::create(array(
						'unit_id'           => $selected_unit,
						'propertable_type'  => $type,
						'propertable_id'    => $id,
						'created_by'        => $user,
						'price'             => $sold_price,
						'month'             => $Today->month,
						'year'              => $Today->year,
						'marked_deleted'    => false,
						'approved'          => false,
						'pending'           => true
					));

					if($request->address_info){
						$client->update(array(
							'street'                => $request->street,
							'state'                 => $request->state,
							'country'               => $request->country,
							'city'                  => $request->city,
							'zip_code'              => $request->zip_code,
							'pending_conversion'    => true
						));
					} else {
						$client->update(array(
							'pending_conversion'    => true
						));
					}

					if($purchase){
						if($client->is_customer == true){
								$request->session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
							return redirect()->route('customers-view-single', array($client->id));
						}

							$request->session()->flash('success', '<strong>Congratulations!</strong> The process has been submited for review successfully.' );
						return redirect()->route('leads-view-single', array($client->id));
					}
				} else {

					$selected_project = (int)$request->selected_project;

					if($request->address_info){
						$client->update(array(
							'street'                => $request->street,
							'state'                 => $request->state,
							'country'               => $request->country,
							'city'                  => $request->city,
							'zip_code'              => $request->zip_cod
						));
					}

						$request->session()->flash('info', '<strong>Note!</strong> you have to choose a Unit in order to complete Submission.' );
					return redirect()->route('leads-convert-step', array($client->id, $selected_project))->with('valid', true);
				}

		} else {
				$request->session()->flash('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.');
			return redirect()->route('leads-view');
		}
	}


	/**
	 * [getConvertStep description]
	 * @param  [type] $id      [description]
	 * @param  [type] $project [description]
	 * @return [type]          [description]
	 */
	public function getConvertStep($id, $project){
		$valide = \Session::get('valid');
		if (\Session::has('valid')){
			\Session::put('valid', true);
		}

		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', false)->first();
		}
		//$conversion = ClientProperty::where('id', $process)->where('marked_deleted', 0)->where('pending', false)->first();

		if($client){
			if($valide == Null) return route('leads-view-single', $client->id);

			$breadcrumb = [];

			$units = Project::where('id', $project)->first()->Units->load('Type', 'Finish');
			return view('clients.convert-project-units', array(
				'breadcrumbs'       => $breadcrumb,
				'lead'              => $client,
				'project_id'        => $project,
				'units'             => $units
			));
		} else {
			return route('leads-view')
				->with('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.');
		}
	}
    /**
     * [postConvertStep description]
     * @param  [type] $id      [description]
     * @param  [type] $project [description]
     * @return [type]          [description]
     */
    
	public function postConvertStep($id, $project){

		if(auth()->user()->userRole->convert_any_customer){
			$client = Client::where('id', $id)->first();
		} else {
			$client = auth()->user()->clientsAssigned()->where('id', $id)->where('marked_deleted', 0)->first();
		}
		//$conversion = ClientProperty::where('id', $process)->where('marked_deleted', 0)->where('pending', false)->first();

		if($client){


			$sold_price     = Input::get('sold_price');
			$unit_type      = Input::get('unit_type');
			$unit_area      = Input::get('unit_area');

			$user = auth()->user()->id;

			$Today      = Carbon::today();
			$purchase = ClientProperty::create(array(
				'project_id'            => $project,
				'propertable_type'      => 'Project',
				'propertable_id'        => $id,
				'price'                 => $sold_price,
				'month'                 => $Today->month,
				'year'                  => $Today->year,
				'created_by'            => $user,
				'marked_deleted'        => false,
				'approved'              => false,
				'pending'               => true
			));

			if($purchase){

				$sale_info = SaleInfo::create(array(
					'transaction_id'    => $purchase->id,
					'unit_type'         => $unit_type,
					'unit_area'         => $unit_area,
					'sold_price'        => $sold_price,
					'created_by'        => $user
				));

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
			}

		} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the Lead intended either no longer exists, is already a Customer or is no longer Assigned to you.-- post conversion');
			return redirect()->route('home');
		}
	}
    



























    /**
     * [getConfirmList description]
     * @return [type] [description]
     */
	public function getConfirmList(){

		PageTitle::add('View Pending Sales Request');

		$projects = ClientProperty::where('pending', true)->where('propertable_type', 'App\Models\Project')->where('marked_deleted', false)->with('userCreated', 'Project', 'projectUnit', 'Client')->get();

		$units    = ClientProperty::where('pending', true)->where('propertable_type', 'App\Models\Unit')->where('marked_deleted', false)->with('userCreated', 'Unit', 'Client')->get();

		return view('clients.pending-requests', array(
			'projects'  => $projects,
			'units'     => $units
		));
	}


    /**
     * [postConfirmSingle description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function postConfirmSingle($id){

		$conversion = ClientProperty::where('id', $id)->where('marked_deleted', 0)->where('pending', true)->first();
		$user = auth()->user()->id;
		$today = date("Y-m-d H:i:s");


		if($conversion){
			if($conversion->Client->is_customer){
				$conversion->Client->update(array(
					'is_customer'           => true,
					'pending_conversion'    => false,
					'last_updated_by'       => $user
				));
			} else {
				$today_date = date("Y-m-d");
				$now_dt = date('Y-m-d H:i:s');

				$conversion->Client->update(array(
					'is_customer'           => true,
					'pending_conversion'    => false,
					'last_updated_by'       => $user,
					'customer_date'         => $today_date,
					'first_property'        => $conversion->id,
					'last_updated'          => $now_dt
				));
			}

			if($conversion->propertable_type == "Unit"){
				$conversion->Unit->update(array(
					'sold'      => true,
					'on_hold'   => false
				));
			}

			$conversion->update(array(
				'approved'          => true,
				'pending'           => false,
				'status_updated_by' => $user,
				'updated_by'        => $user,
				'status_updated_at' => $today
			));

			// approve if num more than 1 
			if ($secondProp = ClientProperty::where('related_to',$id)->where('marked_deleted', 0)->where('pending', true)->first()) {
						$secondProp->update(array(
							'approved'          => true,
							'pending'           => false,
							'status_updated_by' => $user,
							'updated_by'        => $user,
							'status_updated_at' => $today
						));
			}

				session()->flash('success', '<strong>Congratulations!</strong> The Selected Transaction is now Approved Successfully.');
			return redirect()->route('leads-confirm');

		} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the intended Conversion transaction no longer exists, is not pending or the Provided URL is Invalid.');
			return redirect()->route('leads-confirm');
		}
	}

   

    /**
     * [postRejectSingle description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function postRejectSingle($id){
		$conversion = ClientProperty::where('id', $id)->where('marked_deleted', 0)->where('pending', true)->first();

		if($conversion){

				session()->flash('info', '<strong>Note!</strong> you can leave a comment on a Rejected Transaction for the agent and as a future reference.');
			return redirect()->route('leads-convert-comment', array($id));

		} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the intended Conversion transaction no longer exists, is not pending or the Provided URL is Invalid.');
			return redirect()->route('leads-confirm');
		}
	}
	/**
	 * [getRejectComment description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getRejectComment($id){
		$conversion = ClientProperty::where('id', $id)->where('marked_deleted', 0)->where('pending', true)->first();

		if($conversion){

			PageTitle::add('Leave A Comment on a Rejected Conversion Transaction');
			return view('clients.leave-comment', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Leads',
						'crumb_link' => 'leads-view'
					])
					,array([
						'crumb_name' => 'Pending Conversions',
						'crumb_link' => ''
					])
				]),
				'id'  => $id

			));

		} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the intended Conversion transaction no longer exists, is not pending or the Provided URL is Invalid.');
			return redirect()->route('leads-confirm');
		}

	}
	/**
	 * [postRejectComment description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function postRejectComment($id,Request $request){

		$conversion = ClientProperty::where('id', $id)->where('marked_deleted', 0)->where('pending', true)->first();

		if($conversion){
			 $this->validate($request,
								 array(
									 'description'    => 'max:5120'
								 )
								);

		
				$user = auth()->user()->id;

				$comment = $request->description;

				if($conversion->Client->pending_conversion){
					$conversion->Client->update(array(
						'pending_conversion'    => false,
						'last_updated_by'       => $user
					));
				}

				if($conversion->propertable_type == "Unit"){
					$conversion->Unit->update(array(
						'sold'      => false,
						'on_hold'   => false
					));
				}

				$today = date("Y-m-d H:i:s");

				$conversion->update(array(
					'approved'          => false,
					'pending'           => false,
					'status_updated_by' => $user,
					'updated_by'        => $user,
					'status_updated_at' => $today,
					'comment'           => $comment,
					'comment_seen'      => false
				));
				
				// approve if num more than 1 
				if ($secondProp = ClientProperty::where('related_to',$id)->where('marked_deleted', 0)->where('pending', true)->first()) {
							$secondProp->update(array(
									'approved'          => false,
									'pending'           => false,
									'status_updated_by' => $user,
									'updated_by'        => $user,
									'status_updated_at' => $today,
									'comment'           => $comment,
									'comment_seen'      => false
							));
				}


					session()->flash('info', '<strong>Done!</strong> The Selected Transaction is Now Marked as Rejected.');
				return redirect()->route('leads-confirm');
					} else {
				session()->flash('error', '<strong>Error!</strong> It Appears that the intended Conversion transaction no longer exists, is not pending or the Provided URL is Invalid.');
			return redirect()->route('leads-confirm');
		}
	}
	/**
	 * [getSalesList description]
	 * @return [type] [description]
	 */
	public function getSalesList(){
		PageTitle::add('View All Resolved Sales Requests');
		$projects = ClientProperty::where('pending', false)->where('propertable_type', 'App\Models\Project')->where('marked_deleted', false)->with('userCreated', 'Project', 'projectUnit', 'Client')->get();

		$units = ClientProperty::where('pending', false)->where('propertable_type', 'App\Models\Unit')->where('marked_deleted', false)->with('userCreated', 'Unit', 'Client')->get();
		//dd($projects->first()->saleInfo);
		return view('clients.pending-requests', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Sales',
					'crumb_link' => 'sales-view'
				])
				,array([
					'crumb_name' => 'Resolved Sales',
					'crumb_link' => ''
				])
			]),
			'projects'  => $projects,
			'units'     => $units,
			'approved'  => true
		));
	}
	/**
	 * [getSaleModify description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getSaleModify($id){
		PageTitle::add('Modify A Sale Request');
		$sale = ClientProperty::where('id', $id)->where('marked_deleted', false)->first();
		if($sale){
			$all_projects = Project::Where('marked_deleted', false)->where('available', true)->pluck('name', 'id');
			$all_units = UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id');
			//dd($projects->first()->saleInfo);
			return view('clients.modify-request', array(
				'breadcrumbs' => array([
					array([
						'crumb_name' => 'Sales',
						'crumb_link' => 'sales-view'
					])
					,array([
						'crumb_name' => 'Single Sale Request',
						'crumb_link' => ''
					])
				]),
				'sale'  		=> $sale,
				'all_units'		=> $all_units,
				'all_projects'	=> $all_projects
			));
		} else {
			return route('sales-view')
					->with('error', '<strong>Error</strong> Sale Request not found or the provided ID is invalid!');
		}
	}
	/**
	 * [postSaleModify description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function postSaleModify(Request $request,$id){

		$sale = ClientProperty::where('id', $id)->where('marked_deleted', false)->first();

		if($sale){
			   $this->validate($request,
				 array(
					 'project'		=> 'required',
					 'unit'			=> 'required',
					 'unit_area'	=> 'required',
					 'sold_price'	=> 'required'
				 )
				);

				$project 	= $request->project;
				$unit 		= $request->unit;
				$unit_area 	= $request->unit_area;
				$sold_price	= $request->sold_price;

				$user = auth()->user()->id;
				$sale->update(array(
					'project_id'	=> $project,
					'price'			=> $sold_price,
					'updated_by'	=> $user
				));

				$sale->saleInfo->update(array(
					'unit_type'		=> $unit,
					'sold_price'	=> $sold_price,
					'unit_area'		=> $unit_area
				));

					$request->session()->flash('success', '<strong>Congratulations</strong> Sale Request information is modified successfullys!');
				return back();
			
		} else {
					$request->session()->flash('error', '<strong>Error</strong> Sale Request not found or the provided ID is invalid!');
			return back();
		}
	}
	/**
	 * [postSearch description]
	 * @return [type] [description]
	 */
	public function postSearch(Request $request){


			$name                   = $request->name;
			$company                = $request->company;
			$work_title             = $request->work_title;
			$phone                  = $request->mobile;
			$email                  = $request->email;
			$lead_status            = $request->lead_status;
			$lead_source            = $request->lead_source;
			$interested_district    = $request->interested_district;
			$interested_type        = $request->interested_type;
			$cat                    = $request->cat;// seller,buyer
			$from                   = $request->from;
			$to                     = $request->to;


		    $view_all = false;

			$curr_user = $request->assign_to;
			$start_date = "";
			$end_date 	= "";

			$end_raw = $request->end_date;
			if($end_raw != ""){
				$end_date = date('Y-m-d', strtotime($request->end_date));
			}

			$start_raw = $request->start_date;
			if($start_raw != ""){
				$start_date = date('Y-m-d', strtotime($request->start_date));
			}


			$leads 		= Client::select('*');
            
			if($name != "") {
				$leads    = $leads->where('name', 'LIKE', '%'.$name.'%')->orWhere('last_name', 'LIKE', '%'.$name.'%');
			}

			if($company != "") {
				$leads    = $leads->where('company', 'LIKE', '%'.$company.'%');
			}

			//CAT
			if($cat != "1") {
				$leads    = $leads->where('cat', $cat);
			}


            $sub_phones=[];
			if($phone != "") {
				$leads    = $leads->where('Phone', $phone)->orWhere('mobile', $phone)->orWhere('mobile_two', $phone)->orWhere('international_number', $phone);//->orWhereHas('sub',function ($query) use($phone)
				$sub_phones = SubContact::where('phone',$phone)->orWhere('mobile_one',$phone)->orWhere('mobile_two',$phone)->orWhere('international_number',$phone)->pluck('user_id')->toArray();
			}


            $sub_mails = [];
			if($email != "") {
				$leads = $leads->where('email', $email)->orWhere('secondary_email',$email);
				$sub_mails = SubContact::where('email',$email)->pluck('user_id')->toArray();
			}


			if($lead_status != "") {
				$leads = $leads->where('client_status_id', $lead_status);
			}

			if($from != "") {
				$leads = $leads->where('badget_from','>=', $from);
			}

			if($to != "") {
				$leads = $leads->where('badget_to','<=', $to);
			}

			if($lead_source != "") {
				$leads = $leads->where('client_source_id', $lead_source);
			}


			if($interested_district != "1" && $interested_district != "") {
				$leads    = $leads->where('interested_district', $interested_district);
			}

			if($interested_type != "10" && $interested_type != "") {
				$leads = $leads->where('interested_type', $interested_type);
			}

			if($curr_user != ""){
				$leads    = $leads->where('assigned_to', $curr_user);
			}

			if($start_date != ""){
				$leads    = $leads->where(DB::raw('DATE(created_at)'), '>', $start_date);
			}

			if($start_date != ""){
				$leads    = $leads->where(DB::raw('DATE(created_at)'), '<', $end_date);
			}

            $sub_developers = [];
            if ($request->developer_id && count($request->developer_id) > 0) {
            	$sub_developers = array_unique(ClientDeveloper::whereIn('developer_id',$request->developer_id)->pluck('client_id')->toArray());
            }


            $sub_projects = [];
            if ($request->project_id && count($request->project_id) > 0) {
            	$sub_projects = array_unique(ClientProject::whereIn('project_id',$request->project_id)->pluck('client_id')->toArray());
            }

            $arr = [];
            foreach ([$leads->pluck('id')->toArray(),$sub_developers,$sub_projects,$sub_mails,$sub_phones] as $key => $value) {
                     	if (count($value) > 0) {
                     		$arr[] = $value;
                     	}
                     }     

            if (count($arr) > 1) {
                  $ids = array_intersect(...$arr);
            } else {
                  $ids = $arr[0];
            }

           

		// if(auth()->user()->userRole->view_all_leads){

		// 	$leads       = Client::whereIn('id',$ids)->where('newly_assigned',false)->limit(400)->get()->load('userDeleted');
		// 	$no_leads    = Client::whereIn('id',$ids)->where('newly_assigned',true)->limit(400)->get()->load('userDeleted');
		// 	$converted   = Client::whereIn('id',$ids)->where('converted',true)->limit(400)->get()->load('userDeleted');
		// 	$view_all= true;
	
  //       } else if(auth()->user()->role_id == '2'){//

		// 	$leads       = auth()->user()->clientsAssigned()->where('marked_deleted', false)->whereIn('id',$ids)->where('newly_assigned',false)->limit(400)->get()->load('userDeleted');
		// 	$no_leads    = auth()->user()->clientsAssigned()->where('marked_deleted', false)->whereIn('id',$ids)->where('newly_assigned',true)->limit(400)->get()->load('userDeleted');
		// 	$converted   = auth()->user()->clientsAssigned()->where('marked_deleted', false)->whereIn('id',$ids)->where('converted',true)->limit(400)->get()->load('userDeleted');
  //       } else {

		// 	$leads       = auth()->user()->clientsAssigned()->where('marked_deleted', false)->whereIn('id',$ids)->where('newly_assigned',false)->limit(400)->get()->load('userDeleted');
		// 	$no_leads    = Client::whereIn('id',$ids)->where('newly_assigned',true)->limit(400)->get()->load('userDeleted');
		// 	$converted   = auth()->user()->clientsAssigned()->where('marked_deleted', false)->whereIn('id',$ids)->where('converted',true)->limit(400)->get()->load('userDeleted');
  //       }






		if(auth()->user()->userRole->view_all_leads){

			$leads 		= Client::with('userDeleted', 'userAssigned', 'district')->whereIn('id',$ids)
			                                                                     ->where('is_customer', false)
			                                                                     ->where('newly_assigned', false)
			                                                                     ->where('converted', false)
			                                                                     ->latest()->paginate(25);
			$no_leads 	= Client::with('userDeleted', 'userAssigned', 'district')->whereIn('id',$ids)
			                                                                 ->where('is_customer', false)
			                                                                     ->where('newly_assigned', true)
			                                                                     ->where('converted', false)
			                                                                     ->latest()->paginate(25);
			$converted 	= Client::with('userDeleted', 'userAssigned', 'district')->whereIn('id',$ids)
			                                                                 ->where('is_customer', false)
			                                                                     ->where('converted', true)
			                                                                     ->where('newly_assigned', false)
			                                                                     ->latest()->paginate(25);
			$view_all= true;
		} else if(auth()->user()->role_id == '2') {

			$leads 		= auth()->user()->clientsAssigned()->with('district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->where('converted', false)
			                                                                 ->latest()->paginate(25);
			$no_leads 	= auth()->user()->clientsAssigned()->with('district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('newly_assigned', true)
			                                                                 ->where('converted', false)
			                                                                 ->latest()->paginate(25);
			$converted 	= auth()->user()->clientsAssigned()->with('district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('converted', true)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->latest()->paginate(25);
		} else {

			$leads 		= auth()->user()->clientsAssigned()->with('district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->where('converted', false)
			                                                                 ->latest()->paginate(25);
			$no_leads 	= Client::with('userDeleted', 'userAssigned', 'district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                     ->where('is_customer', false)
			                                                                     ->where('newly_assigned', true)
			                                                                     ->where('converted', false)
			                                                                     ->latest()->paginate(25);
			$converted 	= auth()->user()->clientsAssigned()->with('district')->whereIn('id',$ids)
			                                                                 ->where('marked_deleted', false)
			                                                                 ->where('is_customer', false)
			                                                                 ->where('converted', true)
			                                                                 ->where('newly_assigned', false)
			                                                                 ->latest()->paginate(25);

		}





		PageTitle::add('Search Results');
		return view('clients.leadsview', array(
			'breadcrumbs' => array([
				array([
					'crumb_name' => 'Leads',
					'crumb_link' => ''
				])
				,array([
					'crumb_name' => 'View All',
					'crumb_link' => 'leads-view'
				])
			]),
			'leads'     		=> $leads,
			'noaction_leads'	=> $no_leads,
			'converted'	=> $converted,
			'view_all'  		=> $view_all
		))->with('input', $request->all());
	}




   /**
    * [getPhones description]
    * @return [type] [description]
    */
   public function getPhones()
   {
   	  $f1 = DB::table('clients')->where('Phone','!=','')->pluck('Phone')->toArray();
   	  $f2 = DB::table('clients')->where('mobile','!=','')->pluck('mobile')->toArray();
   	  $f3 = DB::table('clients')->where('mobile_two','!=','')->pluck('mobile_two')->toArray();
   	  $f4 = DB::table('clients')->where('international_number','!=','')->pluck('international_number')->toArray();
   	  $f5 = DB::table('sub_contacts')->where('phone','!=','')->pluck('phone')->toArray();
   	  $f6 = DB::table('sub_contacts')->where('mobile_one','!=','')->pluck('mobile_one')->toArray();
   	  $f7 = DB::table('sub_contacts')->where('mobile_two','!=','')->pluck('mobile_two')->toArray();
   	  $f8 = DB::table('sub_contacts')->where('international_number','!=','')->pluck('international_number')->toArray();

   	  $array = array_unique(array_collapse([$f1,$f2,$f3,$f4,$f5,$f6,$f7,$f8]));

   	  return $array;

   }
   /**
    * [getEmails description]
    * @return [type] [description]
    */
   public function getEmails()
   {
   	  $f1 = DB::table('clients')->where('email','!=','')->pluck('email')->toArray();
   	  $f2 = DB::table('clients')->where('secondary_email','!=','')->pluck('secondary_email')->toArray();
   	  $f3 = DB::table('sub_contacts')->where('email','!=','')->pluck('email')->toArray();

   	  $array = array_unique(array_collapse([$f1,$f2,$f3]));

      return $array;
     
   }
   /**
    * [getPhonesForUpdate description]
    * @param string $value [description]
    */
   public function getPhonesForUpdate($id)
   {
   	  $phones = [];
   	  $client = DB::table('clients')->where('id',$id)->first();
   	  $sub = DB::table('sub_contacts')->where('user_id',$id)->first();

   	  if($client->Phone != ''){
         $phones[] = $client->Phone;
   	  }
   	  if($client->mobile != ''){
         $phones[] = $client->mobile;
   	  }
   	  if($client->mobile_two != ''){
         $phones[] = $client->mobile_two;
   	  }
   	  if($client->international_number != ''){
         $phones[] = $client->international_number;
   	  }

   	  if($sub){
	   	  if($sub->phone != ''){
	         $phones[] = $sub->phone;
	   	  }
	   	  if($sub->mobile_one != ''){
	         $phones[] = $sub->mobile_one;
	   	  }
	   	  if($sub->mobile_two != ''){
	         $phones[] = $sub->mobile_two;
	   	  }
	   	  if($sub->international_number != ''){
	         $phones[] = $sub->international_number;
	   	  }
      }

   	  return array_diff($this->getPhones(),$phones);

   }

   /**
    * [getPhonesForUpdate description]
    * @param string $value [description]
    */
   public function getEmailsForUpdate($id)
   {
   	  $emails = [];
   	  $client = DB::table('clients')->where('id',$id)->first();
   	  $sub = DB::table('sub_contacts')->where('user_id',$id)->first();

   	  if($client->email != ''){
         $emails[] = $client->email;
   	  }
   	  if($client->secondary_email != ''){
         $emails[] = $client->secondary_email;
   	  }

   	  if($sub){
	   	  if($sub->email != ''){
	         $emails[] = $sub->email;
	   	  }
      }

   	  return array_diff($this->getEmails(),$emails);

   }

}
