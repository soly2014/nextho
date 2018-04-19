<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Project,ClientSource,ClientStatus,CampaignType,CampaignStatus,CampaignMemberStatus,ProjectDistrict,UnitType,Finish,ActivityType,ActivityStatus};
use PageTitle;


class ParametersController extends Controller {
    

    /**
     * [getAll description]
     * @return [type] [description]
     */
    public function getAll(){

        PageTitle::add('View All Parameters');
        return view('settings.view', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => ''
                ])
            ])
        ));

    }
    
    /**
     * [getClientSource description]
     * @return [type] [description]
     */
    public function getClientSource(){

        $sources = ClientSource::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        PageTitle::add('View All Client Sources');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Client Source',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Client Sources',
            'publish_route'     => 'parameters-client-source-publish',
            'unpublish_route'   => 'parameters-client-source-unpublish',
            'create_route'      => 'parameters-client-source-create',
            'modify_route'      => 'parameters-client-source-modify'
        ));
    }

    /**
     * [getClientSourceCreate description]
     * @return [type] [description]
     */
    public function getClientSourceCreate(){
        
        PageTitle::add('Add New Client Source');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Client Source',
                'crumb_link' => 'parameters-client-source-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-client-source-create-post'
        ));
    }
    /**
     * [postClientSourceCreate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postClientSourceCreate(Request $request){
      
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );
            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = ClientSource::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Client Source "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-client-source-view');
                
            }
    }
    /**
     * [getClientSourceModify description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getClientSourceModify($id){
        $source = ClientSource::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Client Source');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Client Source',
                    'crumb_link' => 'parameters-client-source-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-client-source-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended client source no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-client-source-view');;
        }
    }
    /**
     * [postClientSourceModify description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function postClientSourceModify(Request $request,$id){
      
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );


            $source = ClientSource::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                           session()->flash('success', '<strong>Congratulations!</strong> The Client Source "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-client-source-view');

                }
            } else {
                   session()->flash('error', '<strong>Error!</strong> It Appears that the intended client source no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-client-source-view');
            }
    }
    /**
     * [getClientSourceUnPublish description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getClientSourceUnPublish($id){
        $source = ClientSource::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                   session()->flash('success', '<strong>Congratulations!</strong> The Client Source "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-client-source-view');
            }
        } else {
                   session()->flash('error', '<strong>Error!</strong> It Appears that the intended client source no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-client-source-view');
        }
    }
    public function getClientSourcePublish($id){
        $source = ClientSource::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Client Source "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-client-source-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended client source no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-client-source-view');
        }
    }
    
    /*
     * End ClientSource
     */
    
    /*
     * Client Status
     */
    public function getClientStatus(){
        $sources = ClientStatus::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Client Status');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Client Status',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Client Status',
            'publish_route'     => 'parameters-client-status-publish',
            'unpublish_route'   => 'parameters-client-status-unpublish',
            'create_route'      => 'parameters-client-status-create',
            'modify_route'      => 'parameters-client-status-modify'
        ));
    }
    
    public function getClientStatusCreate(){
        
        PageTitle::add('Add New Client Status');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Client Status',
                'crumb_link' => 'parameters-client-status-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-client-status-create-post'
        ));
    }
    public function postClientStatusCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = ClientStatus::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Client Status "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-client-status-view');
                
                
            }
        
    }
    
    public function getClientStatusModify($id){

        $source = ClientStatus::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Client Status');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Client Status',
                    'crumb_link' => 'parameters-client-status-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-client-status-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Client Status no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-client-status-view');
        }
    }
    
    public function postClientStatusModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );


            $source = ClientStatus::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Client Status "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-client-status-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Client Status no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-client-status-view');
            }

    }
    
    public function getClientStatusUnPublish($id){
        $source = ClientStatus::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Client Status "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-client-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Client Status no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-client-status-view');
        }
    }
    public function getClientStatusPublish($id){
        $source = ClientStatus::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Client Status "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-client-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Client Status no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-client-status-view');
        }
    }
    
    /*
     * End Client Status
     */
    
    /*
     * Campaign Status
     */
    
    public function getCampaignStatus(){
        $sources = CampaignStatus::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Campaign Status');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign Status',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Campaign Status',
            'publish_route'     => 'parameters-campaign-status-publish',
            'unpublish_route'   => 'parameters-campaign-status-unpublish',
            'create_route'      => 'parameters-campaign-status-create',
            'modify_route'      => 'parameters-campaign-status-modify'
        ));
    }
    
    public function getCampaignStatusCreate(){
        
        PageTitle::add('Add New Campaign Status');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign Status',
                'crumb_link' => 'parameters-campaign-status-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-campaign-status-create-post'
        ));
    }
    public function postCampaignStatusCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = CampaignStatus::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                    return redirect()->route('parameters-campaign-status-view');
                        session()->flash('success', '<strong>Congratulations!</strong> The New Campaign Status "'.$label.'" is added successfully.');
                
                
            }
    }
    
    public function getCampaignStatusModify($id){
        $source = CampaignStatus::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Campaign Status');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Campaign Status',
                    'crumb_link' => 'parameters-campaign-status-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-campaign-status-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Status no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-status-view');
        }
    }
    
    public function postCampaignStatusModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = CampaignStatus::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Campaign Status "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-campaign-status-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Status no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-campaign-status-view');
            }
    }
    /**
     * [getCampaignStatusUnPublish description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getCampaignStatusUnPublish($id){

        $source = CampaignStatus::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign Status "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-campaign-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Status no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-status-view');
        }
    }
    public function getCampaignStatusPublish($id){
        $source = CampaignStatus::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign Status "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-campaign-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Status no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-status-view');
        }
    }
    
    /*
     * End Campaign Status
     */
    
    /*
     * Campaign Type
     */
    public function getCampaignType(){
        $sources = CampaignType::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Campaign Types');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign Type',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Campaign Types',
            'publish_route'     => 'parameters-campaign-type-publish',
            'unpublish_route'   => 'parameters-campaign-type-unpublish',
            'create_route'      => 'parameters-campaign-type-create',
            'modify_route'      => 'parameters-campaign-type-modify'
        ));
    }
    
    public function getCampaignTypeCreate(){
        
        PageTitle::add('Add New Campaign Type');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign Type',
                'crumb_link' => 'parameters-campaign-type-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-campaign-type-create-post'
        ));
    }
    public function postCampaignTypeCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );


            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = CampaignType::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Campaign Type "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-campaign-type-view');
                
                
            }

    }
    
    public function getCampaignTypeModify($id){
        $source = CampaignType::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Campaign Type');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Campaign Type',
                    'crumb_link' => 'parameters-campaign-type-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-campaign-type-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Type no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-type-view');
        }
    }
    
    public function postCampaignTypeModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );


            $source = CampaignType::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Campaign Type "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-campaign-type-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Type no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-campaign-type-view');
            }

    }
    
    public function getCampaignTypeUnPublish($id){
        $source = CampaignType::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign Type "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-campaign-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Type no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-type-view');
        }
    }
    public function getCampaignTypePublish($id){
        $source = CampaignType::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign Type "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-campaign-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign Type no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-type-view');
        }
    }
    /*
     * End Campaign Type
     */
    
    /*
     * Campaign-Client Status
     */
    
    public function getCampaignMemberStatus(){
        $sources = CampaignMemberStatus::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Campaign-Member Status');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign-Member Status',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Campaign-Member Status',
            'publish_route'     => 'parameters-campaign-member-status-publish',
            'unpublish_route'   => 'parameters-campaign-member-status-unpublish',
            'create_route'      => 'parameters-campaign-member-status-create',
            'modify_route'      => 'parameters-campaign-member-status-modify'
        ));
    }
    
    public function getCampaignMemberStatusCreate(){
        
        PageTitle::add('Add New Campaign-Member Status');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Campaign-Member Status',
                'crumb_link' => 'parameters-campaign-member-status-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-campaign-member-status-create-post'
        ));
    }
    public function postCampaignMemberStatusCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = CampaignMemberStatus::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Campaign-Member Status "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-campaign-member-status-view');
                
                
            }
    }
    
    public function getCampaignMemberStatusModify($id){
        $source = CampaignMemberStatus::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Campaign-Member Status');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Campaign-Member Status',
                    'crumb_link' => 'parameters-campaign-member-status-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-campaign-member-status-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign-Member Status no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-member-status-view');
        }
    }
    
    public function postCampaignMemberStatusModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = CampaignMemberStatus::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Campaign-Member Status "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-campaign-member-status-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign-Member Status no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-campaign-member-status-view');
            }
    }
    
    public function getCampaignMemberStatusUnPublish($id){
        $source = CampaignMemberStatus::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign-Member Status "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-campaign-member-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign-Member Status no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-member-status-view');
        }
    }
    public function getCampaignMemberStatusPublish($id){
        $source = CampaignMemberStatus::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Campaign-Member Status "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-campaign-member-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Campaign-Member Status no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-campaign-member-status-view');
        }
    }
    
    /*
     * End Campaign-Member Status
     */
    
    /*
     * Districts
     */
    public function getProjectDistrict(){
        $sources = ProjectDistrict::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Districts');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Districts',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Districts',
            'publish_route'     => 'parameters-district-publish',
            'unpublish_route'   => 'parameters-district-unpublish',
            'create_route'      => 'parameters-district-create',
            'modify_route'      => 'parameters-district-modify'
        ));
    }
    
    public function getProjectDistrictCreate(){
        
        PageTitle::add('Add New District');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'District',
                'crumb_link' => 'parameters-district-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-district-create-post'
        ));
    }
    public function postProjectDistrictCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );


            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = ProjectDistrict::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New District "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-district-view');
                
                
            }
    }
    
    public function getProjectDistrictModify($id){
        $source = ProjectDistrict::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify District');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'District',
                    'crumb_link' => 'parameters-district-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-district-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended District no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-district-view');
        }
    }
    
    public function postProjectDistrictModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = ProjectDistrict::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The District "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-district-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended District no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-district-view');
            }
    }
    
    public function getProjectDistrictUnPublish($id){
        $source = ProjectDistrict::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The District "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-district-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended District no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-district-view');
        }
    }
    public function getProjectDistrictPublish($id){
        $source = ProjectDistrict::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The District "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-district-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended District no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-district-view');
        }
    }
    
    /*
     * End Districts
     */
    
    /*
     * Unit Types
     */
    public function getUnitType(){
        $sources = UnitType::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Unit Types');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Unit Types',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Unit Types',
            'publish_route'     => 'parameters-unit-type-publish',
            'unpublish_route'   => 'parameters-unit-type-unpublish',
            'create_route'      => 'parameters-unit-type-create',
            'modify_route'      => 'parameters-unit-type-modify'
        ));
    }
    
    public function getUnitTypeCreate(){
        
        PageTitle::add('Add New Unit Type');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Unit Type',
                'crumb_link' => 'parameters-unit-type-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-unit-type-create-post'
        ));
    }
    /**
     * [postUnitTypeCreate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUnitTypeCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = UnitType::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Unit Type "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-unit-type-view');
                
                
            }
    }
    
    public function getUnitTypeModify($id){
        $source = UnitType::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Unit Type');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Unit Type',
                    'crumb_link' => 'parameters-unit-type-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-unit-type-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Type no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-unit-type-view');
        }
    }
    
    public function postUnitTypeModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = UnitType::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Unit Type "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-unit-type-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Type no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-unit-type-view');
            }

    }
    
    public function getUnitTypeUnPublish($id){
        $source = UnitType::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Unit Type "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-unit-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Type no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-unit-type-view');
        }
    }
    public function getUnitTypePublish($id){
        $source = UnitType::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Unit Type "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-unit-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Type no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-unit-type-view');
        }
    }
    
    /*
     * End Unit Type
     */
    
    /*
     * Unit Finish
     */
    public function getUnitFinish(){
        $sources = Finish::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Unit Finishes');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Unit Finish',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Unit Finishes',
            'publish_route'     => 'parameters-unit-finish-publish',
            'unpublish_route'   => 'parameters-unit-finish-unpublish',
            'create_route'      => 'parameters-unit-finish-create',
            'modify_route'      => 'parameters-unit-finish-modify'
        ));
    }
    
    public function getUnitFinishCreate(){
        
        PageTitle::add('Add New Unit Finish');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Unit Finish',
                'crumb_link' => 'parameters-unit-finish-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-unit-finish-create-post'
        ));
    }
    /**
     * [postUnitFinishCreate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUnitFinishCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = Finish::create(array(
                'label'         => $label,
                'sort_order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Unit Finish "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-unit-finish-view');
                
                
            }

    }
    
    public function getUnitFinishModify($id){
        $source = Finish::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Unit Finish');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Unit Finish',
                    'crumb_link' => 'parameters-unit-finish-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-unit-finish-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Finish no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-unit-finish-view');
        }
    }
    /**
     * [postUnitFinishModify description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function postUnitFinishModify(Request $request,$id){

        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );
            $source = Finish::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'sort_order'    => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Unit Finish "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-unit-finish-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Finish no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-unit-finish-view');
            }

    }
    /**
     * [getUnitFinishUnPublish description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getUnitFinishUnPublish($id){
        $source = Finish::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Unit Finish "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-unit-finish-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Finish no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-unit-finish-view');
        }
    }
    /**
     * [getUnitFinishPublish description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getUnitFinishPublish($id){
        $source = Finish::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Unit Finish "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-unit-finish-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Unit Finish no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-unit-finish-view');
        }
    }
    
    /*
     * End Unit Finishes
     */
    
    /*
     * Activity Types
     */
    public function getActivityType(){
        $sources = ActivityType::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Activity Types');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                ]),
                 array([
                     'crumb_name' => 'Activity Type',
                     'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Activity Types',
            'publish_route'     => 'parameters-activity-type-publish',
            'unpublish_route'   => 'parameters-activity-type-unpublish',
            'create_route'      => 'parameters-activity-type-create',
            'modify_route'      => 'parameters-activity-type-modify'
        ));
    }
    
    public function getActivityTypeCreate(){
        
        PageTitle::add('Add New Activity Type');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Activity Type',
                'crumb_link' => 'parameters-activity-type-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-activity-type-create-post'
        ));
    }
    public function postActivityTypeCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = ActivityType::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Activity Type "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-activity-type-view');
                
                
            }
    }
    
    public function getActivityTypeModify($id){
        $source = ActivityType::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Activity Type');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Activity Type',
                    'crumb_link' => 'parameters-activity-type-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-activity-type-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Type no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-activity-type-view');
        }
    }
    
    public function postActivityTypeModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = ActivityType::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Activity Type "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-activity-type-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Type no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-activity-type-view');
            }
    }
    
    public function getActivityTypeUnPublish($id){
        $source = ActivityType::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity Type "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-activity-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Type no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-activity-type-view');
        }
    }
    public function getActivityTypePublish($id){
        $source = ActivityType::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity Type "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-activity-type-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Type no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-activity-type-view');
        }
    }
    
    /*
     * End Activity Types
     */
    
    /*
     * Activity Status
     */
    public function getActivityStatus(){
        $sources = ActivityStatus::orderBy('sort_order', 'created_at')->get()->load('userCreated');
        
        PageTitle::add('View All Activity Status');
        return view('settings.singleview', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Activity Status',
                'crumb_link' => ''
                ])
            ]),
            'items'             => $sources,
            'title'             => 'View All Activity Status',
            'publish_route'     => 'parameters-activity-status-publish',
            'unpublish_route'   => 'parameters-activity-status-unpublish',
            'create_route'      => 'parameters-activity-status-create',
            'modify_route'      => 'parameters-activity-status-modify'
        ));
    }
    
    public function getActivityStatusCreate(){
        
        PageTitle::add('Add New Activity Status');
        return view('settings.create', array(
            'breadcrumbs' => array([
                array([
                'crumb_name' => 'Parameters',
                'crumb_link' => 'parameters-view'
                ]),
                 array([
                'crumb_name' => 'Activity Status',
                'crumb_link' => 'parameters-activity-status-view'
                ]),
                 array([
                'crumb_name' => 'Add New',
                'crumb_link' => ''
                ])
            ]),
            'post'  => 'parameters-activity-status-create-post'
        ));
    }
    public function postActivityStatusCreate(Request $request){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $label = $request->label;
            $order = $request->sort_order;
            $user = auth()->user()->id;
            
            $source = ActivityStatus::create(array(
                'label'         => $label,
                'order'         => $order,
                'published'     => true,
                'created_by'    => $user
            ));
            
            if($source){
                
                $submit = $request->submit;

                        session()->flash('success', '<strong>Congratulations!</strong> The New Activity Status "'.$label.'" is added successfully.');
                    return redirect()->route('parameters-activity-status-view');
                
                
            }
    }
    
    public function getActivityStatusModify($id){
        $source = ActivityStatus::where('id', $id)->first();
        
        if($source){
            PageTitle::add('Modify Activity Status');
            return view('settings.modify', array(
                'breadcrumbs' => array([
                    array([
                    'crumb_name' => 'Parameters',
                    'crumb_link' => 'parameters-view'
                    ]),
                     array([
                    'crumb_name' => 'Activity Status',
                    'crumb_link' => 'parameters-activity-status-view'
                    ]),
                     array([
                    'crumb_name' => 'Modify',
                    'crumb_link' => ''
                    ])
                ]),
                'post'      => 'parameters-activity-status-modify-post',
                'object'    => $source
            ));
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Status no longer exists or the provided URL is invalid.');
            return redirect()->route('parameters-activity-status-view');
        }
    }
    
    public function postActivityStatusModify(Request $request,$id){
        $this->validate($request, 
             array(
                 'label'        => 'required',
                 'sort_order'   => 'required'
             )
            );

            $source = ActivityStatus::where('id', $id)->first();
            
            if($source){
                $label = $request->label;
                $order = $request->sort_order;
                $user = auth()->user()->id;

                $op = $source->update(array(
                    'label'         => $label,
                    'order'         => $order,
                    'updated_by'    => $user
                ));

                if($op){

                    $submit = $request->submit;

                            session()->flash('success', '<strong>Congratulations!</strong> The Activity Status "'.$label.'" is modified successfully.');
                        return redirect()->route('parameters-activity-status-view');
                    

                }
            } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Status no longer exists or the provided URL is invalid.');
                return redirect()->route('parameters-activity-status-view');
            }
    }
    
    public function getActivityStatusUnPublish($id){
        $source = ActivityStatus::where('id', $id)->where('published', true)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => false,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity Status "'.$source->label.'" unpublished successfully.');
                return redirect()->route('parameters-activity-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Status no longer exists, is already unpublished or the provided URL is invalid.');
            return redirect()->route('parameters-activity-status-view');
        }
    }
    public function getActivityStatusPublish($id){
        $source = ActivityStatus::where('id', $id)->where('published', false)->first();
        
        if($source){
            $user = auth()->user()->id;
            $op = $source->update(array(
                'published'     => true,
                'updated_by'    => $user
            ));
            
            if($op){
                    session()->flash('success', '<strong>Congratulations!</strong> The Activity Status "'.$source->label.'" is published successfully.');
                return redirect()->route('parameters-activity-status-view');
            }
        } else {
                    session()->flash('error', '<strong>Error!</strong> It Appears that the intended Activity Status no longer exists, is already published or the provided URL is invalid.');
            return redirect()->route('parameters-activity-status-view');
        }
    }
}