<?php 

namespace App\Http\Controllers;


use \App\Models\{Activity,ClientProperty,Forecast,User,Client,UserAction,ClientSource,ClientStatus,ClientUser,Project,UnitType,Note,Attachment,Role};
use Illuminate\Http\Request;
use PageTitle;


class RoleController extends Controller {
    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll(){
        $roles = Role::orderBy('active', 'ASC')->orderBy('created_at', 'ASC')->get()->load('userCreated', 'usersCount');
        PageTitle::add('View All Roles');
        return view('users.roles.view', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Roles',
                'crumb_link' => ''
                ])
            ]),
            'roles'   => $roles
        ));
    } 
    /**
     * [getCreate description]
     * @return [type] [description]
     */
    public function getCreate(){
        PageTitle::add('View All Roles');
        //$roles = Role::where('active', true)->orderBy('id')->lists('role_name', 'id');
        return view('users.roles.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Roles',
                    'crumb_link' => 'roles-view'
                ]),
                array([
                    'crumb_name' => 'Create Role',
                    'crumb_link' => ''
                ])
            ])
        ));
    }
    
    public function postCreate(){
        
    }
    
}