<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Project};
use PageTitle;

class ProjectController extends Controller {



    public function getAll()
    {
        if(auth()->user()->userRole->view_all_projects){
            $projects = Project::all();
        } else {
            $projects = Project::where('marked_deleted', false)->where('available', true)->get();
        }
        
        PageTitle::add('View Projects');
        return view('projects.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Projects',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'leads-view'
                ])
            ]),
            'projects'  => $projects
        ));
    }
    
    public function getCreate()
    {
        PageTitle::add('Create A New Project');
        return view('projects.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Projects',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Create Project',
                    'crumb_link' => 'projects-create'
                ])
            ])
        ));
    }
    public function postCreate()
    {
        $validator = $this->validate($request, 
             array(
                 'name'             => 'required',
                 'district'         => 'required',
                 'commision'        => 'required',
                 'delivery_date'    => 'required',
                 'description'      => 'max:5120',
                 'facilities'       => 'max:5120'
             )
        );

        if($validator -> fails()) {
            return route('projects-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $name           = Input::get('name');
            $delivery_date  = date('Y-m-d', strtotime(Input::get('delivery_date')));
            $district       = Input::get('district');
            $commision      = Input::get('commision');
            $available      = Input::has('available') ? true : false;
            $description    = Input::get('description');
            $facilities     = Input::get('facilities');
            
            $user = auth()->User()->id;
            
            $project = Project::create(array(
                'name'                  => $name,
                'delivery_date'         => $delivery_date,
                'district'             => $district,
                'available'             => $available,
                'description'           => $description,
                'facilities'            => $facilities,
                'commision_percentag'   => $commision,
                'marked_deleted'        => false,
                'created_by'            => $user
            ));
            
            if($project){
                $submit = Input::get('submit');
                
                if($submit == "save"){
                    return route('projects-view-single', array($project->id));
                } else if($submit == "save-new"){
                    return route('projects-create')
                        ->with('success', '<strong>Congratulations!</strong> The new Project "'.$name.'" has been created successfully.');
                } else {
                    return route('projects-view')
                        ->with('success', '<strong>Congratulations!</strong> The new Project "'.$name.'" has been created successfully.');
                }
            }
            
        }
        
    }
    
    public function getSingle($id){
        
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->view_all_projects){
            $project = Project::where('id', $id)->first();
        } else {
            $project = Project::where('id', $id)->where('marked_deleted', false)->where('available', true)->first();
        }
        
        if($project){
            
            if(auth()->user()->userRole->view_all_project_units){
                $units = $project->Units()->with('Type', 'Finish', 'userDeleted')->get();
            } else {
                $units = $project->Units()->with('Type', 'Finish')->where('marked_deleted', false)->get();
            }

            if(auth()->user()->userRole->view_all_project_emails){
                $emails = $project->emails()->with('userCreated')->orderBy('expiry_date', 'ASC')->get();
            }else{
                $emails = $project->emails()->with('userCreated')->where('marked_deleted', false)->where('published', true)->orderBy('expiry_date', 'ASC')->get();
            }

            if(auth()->user()->userRole->view_all_project_notes){
                $notes = $project->notes()->get();
            } else if(auth()->user()->userRole->view_project_notes){
                $notes = $project->notes()->where('marked_deleted', 0)->get();
            } else {
                $notes = $project->notes()->where('marked_deleted', 0)->where('note_owner', $user)->get();
            }

            $add_notes = auth()->user()->userRole->add_project_notes;
            
            PageTitle::add('View Project Details');
            return view('projects.singleview', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Projects',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'View All',
                        'crumb_link' => 'projects-view'
                    ])
                ]),
                'object'            => $project,
                'units'             => $units,
                'emails'            => $emails,
                'notes'             => $notes,
                'add_note'          => $add_notes,
                'model_type'        => 'Project',
            ));
        } else {
            return route('projects-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Project you are looking for either no longer exists or The URL Provided is invalid .');
        }
    }
    
    public function getModify($id)
    {
        if(auth()->user()->userRole->view_all_projects){
            $project = Project::where('id', $id)->first();
        } else {
            $project = Project::where('id', $id)->where('marked_deleted', false)->where('available', true)->first();
        }
        
        if($project){
            PageTitle::add('Projects');
            return view('projects.modify', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Projects',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'Modify Project',
                        'crumb_link' => 'projects-modify-single'
                    ])
                ]),
                'project'   => $project
            ));
        } else {
            return route('projects-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Project you are looking for either no longer exists or The URL Provided is invalid .');
        }
    }
    
    public function postModify($id){
        
        if(auth()->user()->userRole->view_all_projects){
            $project = Project::where('id', $id)->first();
        } else {
            $project = Project::where('id', $id)->where('marked_deleted', false)->where('available', true)->first();
        }
        
        if($project){
            $validator = $this->validate($request, 
                 array(
                     'name'                 => 'required',
                     'district'             => 'required',
                     'commision_percentag'  => 'required',
                     'delivery_date'        => 'required',
                     'description'          => 'max:5120',
                     'facilities'           => 'max:5120'
                 )
            );

            if($validator -> fails()) {
                return route('projects-create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $name           = Input::get('name');
                $delivery_date  = date('Y-m-d', strtotime(Input::get('delivery_date')));
                $district       = Input::get('district');
                $commision      = Input::get('commision_percentag');
                $available      = Input::has('available') ? true : false;
                $description    = Input::get('description');
                $facilities     = Input::get('facilities');

                $user = auth()->User()->id;

                $query = $project->update(array(
                    'name'                  => $name,
                    'delivery_date'         => $delivery_date,
                    'district'              => $district,
                    'available'             => $available,
                    'description'           => $description,
                    'facilities'            => $facilities,
                    'commision_percentag'   => $commision,
                    'updated_by'            => $user
                ));

                if($query){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('projects-view-single', array($project->id));
                    } else if($submit == "save-new"){
                        return route('projects-create')
                            ->with('success', '<strong>Congratulations!</strong> The new Project "'.$name.'" has been created Modified.');
                    } else {
                        return route('projects-view')
                            ->with('success', '<strong>Congratulations!</strong> The new Project "'.$name.'" has been created Modified.');
                    }
                }

            }
        } else {
            return route('projects-view')
                ->with('error', '<strong>Error!</strong> It Appears that the Project you are looking for either no longer exists or The URL Provided is invalid .');
        }
    }
    
    
    /*
     * Create Units
     */
    
    public function postCreateUnit($id){
        
        if(auth()->user()->userRole->view_all_projects){
            $project = Project::where('id', $id)->first();
        } else {
            $project = Project::where('id', $id)->where('marked_deleted', false)->where('available', true)->first();
        }
        
        if($project){
            $messages = array(
                'greater_than' => 'The Area To field is Must be Grgeater than the Area From feild.',
            );
            $validator = $this->validate($request, 
                 array(
                     'unit_type'        => 'required',
                     'unit_finish'      => 'required',
                     'unit_area_from'   => 'required',
                     'unit_area_to'     => 'required|greater_than:unit_area_from',
                     'delivery_date'    => 'required',
                     'starting_price'   => 'required'
                 ),
                 $messages
            );

            if($validator -> fails()) {
                return route('unit-create', array($id))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $unit_from = round(Input::get('unit_area_from'), 2);
                $unit_to = round(Input::get('unit_area_to'), 2);
                $delivery_date = date('Y-m-d', strtotime(Input::get('delivery_date')));
                
                $user = auth()->user()->id;
                
                $unit = ProjectUnit::create(array(
                    'project_id'        => $id,
                    'unit_type'         => Input::get('unit_type'),
                    'unit_finish'       => Input::get('unit_finish'),
                    'starting_price'    => Input::get('starting_price'),
                    'unit_area_from'    => $unit_from,
                    'unit_area_to'      => $unit_to,
                    'delivery_date'     => $delivery_date,
                    'available'         => true,
                    'created_by'        => $user,
                    'marked_deleted'    => false
                ));
                
                if($unit){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('projects-view-single', array($project->id))
                            ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                    } else if($submit == "save-new"){
                        return route('unit-create', array($project->id))
                            ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                    }
                }
            }
        } else {
            return route('projects-view')
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function getCreateUnit($id){
        
        if(auth()->user()->userRole->view_all_projects){
            $project = Project::where('id', $id)->first();
        } else {
            $project = Project::where('id', $id)->where('marked_deleted', false)->where('available', true)->first();
        }
        
        if($project){
            PageTitle::add('Add A New Unit');
            return view('projects.addunit', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Projects',
                        'crumb_link' => 'projects-view'
                    ])
                    ,array([
                        'crumb_name' => $project->name,
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'Add Unit',
                        'crumb_link' => ''
                    ])
                ]),
                'project'   => $project
            ));
        } else {
            return route('projects-view')
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function getModifyUnit($id, $unit_id){
        
        if(auth()->user()->userRole->view_all_projects){
            $unit = ProjectUnit::where('project_id', $id)->where('id', $unit_id)->first();
        } else {
            $unit = ProjectUnit::where('project_id', $id)->where('id', $unit_id)->where('marked_deleted', false)->first();
        }
        
        if($unit){
            PageTitle::add('Modify A Unit Details');
            return view('projects.modifyunit', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Projects',
                        'crumb_link' => 'projects-view'
                    ])
                    ,array([
                        'crumb_name' => $unit->Project->name,
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'Modify Unit',
                        'crumb_link' => ''
                    ])
                ]),
                'unit'   => $unit
            ));
        } else {
            return Redirect::previous()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project Unit either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function postModifyUnit($id, $unit_id){

        if(auth()->user()->userRole->view_all_projects){
            $unit = ProjectUnit::where('project_id', $id)->where('id', $unit_id)->first();
        } else {
            $unit = ProjectUnit::where('project_id', $id)->where('id', $unit_id)->where('marked_deleted', false)->first();
        }
        
        if($unit){
            
            $messages = array(
                'greater_than' => 'The Area To field is Must be Grgeater than the Area From feild.',
            );
            $validator = $this->validate($request, 
                 array(
                     'unit_type'        => 'required',
                     'unit_finish'      => 'required',
                     'unit_area_from'   => 'required',
                     'unit_area_to'     => 'required|greater_than:unit_area_from',
                     'delivery_date'    => 'required',
                     'starting_price'   => 'required'
                 ),
                 $messages
            );

            if($validator -> fails()) {
                return route('unit-modify', array($unit->project_id, $unit->id))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $unit_from = round(Input::get('unit_area_from'), 2);
                $unit_to = round(Input::get('unit_area_to'), 2);
                $delivery_date = date('Y-m-d', strtotime(Input::get('delivery_date')));
                
                $user = auth()->user()->id;
                
                $query = $unit->update(array(
                    'unit_type'         => Input::get('unit_type'),
                    'unit_finish'       => Input::get('unit_finish'),
                    'starting_price'    => Input::get('starting_price'),
                    'unit_area_from'    => $unit_from,
                    'unit_area_to'      => $unit_to,
                    'delivery_date'     => $delivery_date,
                    'updated_by'        => $user
                ));
                
                if($query){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('projects-view-single', array($unit->project_id))
                            ->with('success', '<strong>Congratulations!</strong> The Unit Details has been Modified successfully.');
                    } else if($submit == "save-new"){
                        return route('unit-create', array($unit->project_id))
                            ->with('success', '<strong>Congratulations!</strong> The Unit Details has been Modified successfully.');
                    }
                }
            }
        
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project Unit either no longer exists or The URL Provided is invalid.');
        }
    
    }
    
    public function postDeleteUnit($id){
        
        if(auth()->user()->userRole->view_all_projects){
            $unit = ProjectUnit::where('id', $id)->first();
        } else {
            $unit = ProjectUnit::where('id', $id)->where('marked_deleted', false)->first();
        }
        
        $user = auth()->user()->id;
        
        if($unit){
            
            $query = $unit->update([
                'marked_deleted'    => true,
                'deleted_by'        => $user
            ]);
            
            if($query){
                return route('projects-view-single', array($unit->project_id))
                    ->with('success', '<strong>Congratulations!</strong> The Intended Unit is Deleted successfully.');
            }
            
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project Unit either no longer exists or The URL Provided is invalid.');
        }
    }
    public function postRestoreUnit($id){
        
        $unit = ProjectUnit::where('id', $id)->where('marked_deleted', true)->first();
        
        $user = auth()->user()->id;
        
        if($unit){
            
            $query = $unit->update([
                'marked_deleted'    => false,
                'deleted_by'        => null
            ]);
            
            if($query){
                return route('projects-view-single', array($unit->project_id))
                    ->with('success', '<strong>Congratulations!</strong> The Intended Unit is Restored successfully.');
            }
            
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project Unit either no longer exists or The URL Provided is invalid.');
        }
    }
    
    public function postDelete($id){
        $project = Project::where('id', $id)->where('marked_deleted', false)->first();
        
        if($project){
            $user = auth()->user()->id;
            $now_dt = date('Y-m-d H:i:s');
            $op = $project->update(array(
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ));
            if($op){
                return route('projects-view')
                    ->with('success', '<strong>Congratulations!</strong> The Intended Project is Deleted successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }
    
    public function postRestore($id){
        $project = Project::where('id', $id)->where('marked_deleted', true)->first();
        
        if($project){
            $op = $project->update(array(
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ));
            if($op){
                return route('projects-view-single', array($project->id))
                    ->with('Success', '<strong>Congratulations!</strong> The Intended Project is Restored successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Project either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }
    
    public function postSearch(){
        $validator = $this->validate($request, 
             array(
                 'min_price'        => 'integer',
                 'max_price'        => 'integer',
                 'min_area'         => 'integer',
                 'max_area'         => 'integer',
                 'delivery_date'    => 'integer'
             )
        );

        if($validator -> fails()) {
            return route('projects-view')
                ->withErrors($validator)
                ->withInput();
        } else {
            $project_district   = Input::get('district');
            
            $unit_type          = Input::get('unit_type');
            $finish             = Input::get('finish');
            $delivery_date      = Input::get('delivery_date');
            $min_area           = Input::get('min_area');
            $max_area           = Input::get('max_area');
            $min_price          = Input::get('min_price');
            $max_price          = Input::get('max_price');
            
            $projects = Project::where('projects.available', true)->where('projects.marked_deleted', false);
            
            if($project_district != '' && $project_district != '1'){
                $projects = $projects->where('projects.district', $project_district);
            }
            $left_join = true;
            if($unit_type != '' && $unit_type != '10'){
                if(!$left_join){
                    $projects = $projects->leftJoin('project_units', 'projects.id', '=', 'project_units.project_id');
                    $left_join = true;
                }
                $projects = $projects->from('project_units', 'projects')
                    ->whereRaw('project_units.project_id = projects.id');
                $projects = $projects->where('project_units.unit_type', $unit_type);
            }
            if($finish != '' && $finish != '10'){
                if(!$left_join){
                    $projects = $projects->leftJoin('project_units', 'projects.id', '=', 'project_units.project_id');
                    $left_join = true;
                }
                $projects = $projects->where('project_units.unit_finish', $finish);
            }
            
            $projects = $projects->get()->toJson();
            dd($projects);
            
        }
    }
    
  

}
