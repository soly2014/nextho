<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction};
use Carbon\Carbon;
use DB;
use PageTitle;

class AccountController extends Controller {
    
    public function getSignIn() {
        PageTitle::add('Sign In');
        return view('account.signin');
    }
    
    public function postSignIn(Request $request) {
        

        $this->validate($request, 
             array(
                 'email'            => 'required|email',
                 'password'         => 'required',
             )
        );
        

        $remember = ($request->has('remember')) ? true : false;
        
        $auth = auth()->attempt(array(
                'email'     => $request->email,
                'password'  => $request->password,
                'active'    => true
        ), $remember);
        
        if($auth) {
            $today_now = date("Y-m-d H:i:s");
            
            auth()->user()->update(array(
                'last_login'    => $today_now
            ));
            
            return redirect('/');
        }
        session()->flash('failed', '<strong>Sign in Failed!</strong> Either the Username or the Password Provided is incorrect or the User is no longer active, please try again!');
        PageTitle::add('Sign In');
        return redirect()->route('account-sign-in');

    }
    /**
     * [getSignOut description]
     * @return [type] [description]
     */
    public function getSignOut() {
        auth()->logout();
        return redirect()->route('account-sign-in');
    }

}
