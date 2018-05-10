<?php 

namespace App\Http\Controllers;

use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Note,Attachment,Role};
use Illuminate\Http\Request;
use PageTitle;
use Datatables;
use Carbon\Carbon;

class UserController extends Controller {
    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll(){
        $users = User::orderBy('active', 'ASC')->orderBy('created_at', 'ASC')->get();
        PageTitle::add('View All Users');
        return view('users.view', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Users',
                'crumb_link' => ''
                ])
            ]),
            'users'   => $users
        ));
    }
    /**
     * [getCreate description]
     * @return [type] [description]
     */
    public function getCreate(){
        $roles = Role::where('active', true)->orderBy('id')->pluck('role_name', 'id')->toArray();

        PageTitle::add('Create New User');
        return view('users.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Users',
                'crumb_link' => 'users-view'
                ]),
                array([
                    'crumb_name' => 'Create User',
                    'crumb_link' => ''
                ])
            ]),
            'roles' => $roles
        ));
    }

    /**
     * [postCreate description]
     * @return [type] [description]
     */
    public function postCreate(Request $request){

        PageTitle::add('Create New User');

         $this->validate($request,
             array(
                 'email'            => 'required|max:50|email|unique:users',
                 'username'         => 'required|max:50|min:5',
                 'password'         => 'required|min:6',
                 'ReType_Password'  => 'required|same:password'
             )
        );


            $email      = $request->email;
            $username   = $request->username;
            $password   = $request->password;
            $role_id    = $request->role;

            // Activation Code
            //$code       = str_random(60);

            $auth_user = auth()->user()->id;

            $user = User::create(array(
                'email'         => $email,
                'username'      => $username,
                'password'      => bcrypt($password),
                'role_id'       => $role_id,
                'active'        => true,
                'created_by'    => $auth_user
            ));

            if($user){
                $submit = $request->submit;

                if($submit == "save"){
                        session()->flash('success', '<strong>Congratulations!</strong> The new User "'.$username.'" has been created Successfully.');;
                    return redirect()->route('users-view-single', array($user->id));
                } else if($submit == "save-new"){
                        session()->flash('success', '<strong>Congratulations!</strong> The new User "'.$username.'" has been created Successfully.');
                    return redirect()->route('users-create');
                } else {
                        session()->flash('success', '<strong>Congratulations!</strong> The new User "'.$username.'" has been created Successfully.');
                    return redirect()->route('users-view');
                }
            }

    }
    

    /**
     * [getUser description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getUser($id){
        
        $user = User::where('id', $id)->first();

        PageTitle::add(('View "'.$user->username.'" Details'));
        if($user){
            $Today      = Carbon::today();
            $mothly_forecast = $Quarter_forecast = $yearly_forecasts = $mothly_sales = $Quarter_sales = $yearly_sales = $actions_month = $actions_quarter = $actions_yearly = $new_leads = 0;
            if($user->role_id == 2){
                 $year = $Today->year;

                $soldProperties = $user->soldProperties()->selectRaw('sum(price) as aggregate, month')->where('year', $year)->where('approved', true)->groupBy('month', 'year')->orderBy('month', 'ASC')->pluck('aggregate', 'month')->toArray();

                $forecasts = Forecast::where('marked_deleted', false)->where('year', $year)->orderBy('month')->pluck('amount', 'month')->toArray();

                ////////////////////////////////////////////////////

                //Quarterly States
                $Quarter_first_day = $Today->firstOfQuarter()->month - 1;

                $Quarter_sales      = 0;
                $Quarter_forecast   = 0;
                for($i=1; $i<($Quarter_first_day+3); $i++){
                    //var_dump($i);
                    if(isset($forecasts[$i])){
                        if(isset($soldProperties[$i])){
                            $Quarter_sales      += $soldProperties[$i];
                        }
                        $Quarter_forecast   += $forecasts[$i];
                    }
                }
                //dd($Quarter_forecast);
                //yearly Stats
                $yearly_sales       = array_sum($soldProperties);
                $yearly_forecasts   = array_sum($forecasts);

                $Today      = Carbon::today();

                $month = $Today->month;
                $mothly_forecast    = 0;
                $mothly_sales       = 0;
                if(isset($forecasts[$month]) && $forecasts[$month]){
                    $mothly_forecast = $forecasts[$month];
                }
                if(isset($soldProperties[$month]) && $soldProperties[$month]){
                    $mothly_sales = $soldProperties[$month];
                }
                //New Leads
                $new_leads = $user->clientsAssigned()->where('newly_assigned', true)->where('marked_deleted', false)->where('is_customer', false)->count();
                //Monthly Follow ups
                $Today      = Carbon::today();
                $first_day  = $Today->startOfMonth();

                $Today      = Carbon::today();
                $last_day   = $Today->endOfMonth();

                $actions_month = 20;//$user->clientsActions()->whereBetween('date', array($first_day, $last_day))->groupBy('date', 'client_id')->get()->count();

                /////////////////////

                //Quarterly Follow Ups
                $Today              = Carbon::today();
                $quarter_start_day  = $Today->firstOfQuarter();

                $Today              = Carbon::today();
                $quarter_end_day    = $Today->lastOfQuarter();

                $actions_quarter = 30;//$user->clientsActions()->whereBetween('date', array($quarter_start_day, $quarter_end_day))->groupBy('date', 'client_id')->get()->count();

                /////////////////////

                //Yearly Follow Ups
                $Today              = Carbon::today();
                $year_start_day  = $Today->firstOfYear();

                $Today              = Carbon::today();
                $year_end_day    = $Today->lastOfYear();

                $actions_yearly = 40;//$user->clientsActions()->whereBetween('date', array($year_start_day, $year_end_day))->groupBy('date', 'client_id')->get()->count();


            }

            $no_leads 	= Client::with('userDeleted', 'userAssigned', 'district')->where('is_customer', false)->where('newly_assigned', true)->where('assigned_to', $id)->paginate(25);
            
            return view('users.singleview', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Users',
                    'crumb_link' => 'users-view'
                    ]),
                    array([
                        'crumb_name' => 'User Details',
                        'crumb_link' => ''
                    ])
                ]),
                'user'              => $user,
                'leads'             => $user->clientsAssigned()->where('is_customer', false)->orderBy('created_at', 'asc')->get(),
                'customers'         => $user->clientsAssigned()->where('is_customer', true)->orderBy('customer_date', 'asc')->get()->load('propertiesCount', 'propertiesAmount'),
                'open_activities'   => $user->activities()->whereNotIn('status', [4])->orderBy('due_date', 'asc')->get()->load('clientBelongsTo', 'activityType', 'activityStatus'),
                'closed_activitied' => $user->activities()->where('status', 4)->get(),
                'forecast_month'        => $mothly_forecast,
                'forecast_quarter'      => $Quarter_forecast,
                'forecast_year'         => $yearly_forecasts,
                'sales_month'           => $mothly_sales,
                'sales_quarter'         => $Quarter_sales,
                'sales_year'            => $yearly_sales,
                'monthly_follow_ups'    => 420,
                'monthly_actions'       => $actions_month,
                'quarterly_actions'     => $actions_quarter,
                'yearly_actions'        => $actions_yearly,
                'new_leads'             => $new_leads,
                'no_action_lead'        => $no_leads
            ));

        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended either no longer exists or URL provided is invalid.');
            return redirect()->route('users-view');
        }
    }
    /**
     * [getModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getModify($id){
        $user = User::where('id', $id)->first();

        if($user){
            $roles = Role::where('active', true)->orderBy('id')->pluck('role_name', 'id')->toArray();

            PageTitle::add('Create New User');
            return view('users.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Users',
                    'crumb_link' => 'users-view'
                    ]),
                    array([
                        'crumb_name' => 'Create User',
                        'crumb_link' => ''
                    ])
                ]),
                'roles' => $roles,
                'user'  => $user
            ));

        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended either no longer exists or URL provided is invalid.');
            return redirect()->route('users-view');
        }
    }

    /**
     * [postModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postModify(Request $request,$id){

        $user = User::where('id', $id)->first();

        if($user){
           $this->validate($request,
                 array(
                     'email'            => 'required|max:50|email|unique:users,email,'.$id,
                     'username'         => 'required|max:50|min:5',
                 )
            );

                $email      = $request->email;
                $username   = $request->username;
                $role_id    = $request->role;

                // Activation Code
                //$code       = str_random(60);

                $auth_user = auth()->user()->id;

                $action = $user->update(array(
                    'email'         => $email,
                    'username'      => $username,
                    /*'code'      => $code,*/
                    'role_id'       => $role_id,
                    'updated_by'    => $auth_user
                ));

                if($action){
                    $submit = $request->submit;

                    if($submit == "save"){
                            session()->flash('success', '<strong>Congratulations!</strong> The new User "'.$username.'" has been created Successfully.');;
                        return redirect()->route('users-view-single', array($user->id));
                    }
                }

        }
    }
    /**
     * [getPasswordReset description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getPasswordReset($id){
        $user = User::where('id', $id)->first();

        if($user){
            PageTitle::add('Reset The User "'.$user->username.'" Password');
            return view('users.password-reset', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Users',
                    'crumb_link' => 'users-view'
                    ]),
                    array([
                        'crumb_name' => 'Create user',
                        'crumb_link' => ''
                    ])
                ]),
                'user'  => $user
            ));
        }
    }
    /**
     * [postPasswordReset description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postPasswordReset(Request $request,$id){
        $user = User::where('id', $id)->first();

        if($user){
            $validator = $this->validate($request,
             array(
                     'password'         => 'required|min:6',
                     'ReType_Password'  => 'required|same:password'
                 )
            );


                $password   = $request->password;

                $action = $user->update(array(
                    'password'  =>  bcrypt($password)
                ));

                if($action){
                    session()->flash('success', ('<strong>Congratulations!</strong> The User "'.$user->username.'" password is reset Successfully.'));
                    return redirect()->route('users-view-single', array($user->id));
                }
        }

    }

    public function getPasswordChange(){

    }
    public function postPasswordChange(){

    }
    /**
     * [postUserDeactivate description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postUserDeactivate($id){
        $user = User::where('id', $id)->where('active', true)->first();

        if($user){
            $today = date("Y-m-d H:i:s");
            $action = $user->update(array(
                'active'            => false,
                'deactivated_at'    => $today
            ));

            if($action){
                    session()->flash('success', ('<strong>Congratulations!</strong> The User "'.$user->username.'" is deactivated Successfully.'));
                return redirect()->route('users-view');
            }
        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended either doesn\'t exist, is already deactivated or URL provided is invalid.');
            return back();
        }
    }
    /**
     * [postUserReactivate description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postUserReactivate($id){
        $user = User::where('id', $id)->where('active', false)->first();

        if($user){
            $action = $user->update(array(
                'active'            => true,
                'deactivated_at'    => null
            ));

            if($action){
                    session()->flash('success', ('<strong>Congratulations!</strong> The User "'.$user->username.'" is Reactivated Successfully.'));
                return redirect()->route('users-view-single', array($user->id));
            }
        } else {
                session()->flash('error', '<strong>Error!</strong> It Appears that the User intended either doesn\'t exist, is already active or URL provided is invalid.');
            return back();
        }
    }
    /**
     * [changePassword description]
     * @return [type] [description]
     */
    public function changePassword()
    {
        return view('users.changepassword');
    }
    /**
     * [psotChangePassword description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function postChangePassword(Request $request)
    {
        auth()->user()->update(['password'=>bcrypt($request->password_update)]);
        session()->flash('success', '<strong>Success!</strong> Password Updated Successfully.');
        return back();

    }
}
