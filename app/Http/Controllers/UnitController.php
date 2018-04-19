<?php 

namespace App\Http\Controllers;




use Illuminate\Http\Request;


class UnitController extends Controller {



    public function getAll(){
        $view_all = false;
        if(auth()->user()->userRole->view_all_units){
            $units  = Unit::all()->load('saleInfo', 'saleInfo.userCreated');
            $view_all = true;
        } else {
            $units  = Unit::where('marked_deleted', false)->where('on_hold', false)->where('sold', false)->get();
        }
        PageTitle::add('View All Individual Units');
        return view('units.view', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Units',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'View All',
                    'crumb_link' => 'units-view'
                ])
            ]),
            'units'     => $units,
            'view_all'  => $view_all
        ));
    }
    public function getCreate(){
        $unit_id = mt_rand(1000,9999);
        PageTitle::add('Create A New Unit');
        return view('units.create', array(
            'breadcrumbs' => array([
                array([
                    'crumb_name' => 'Units',
                    'crumb_link' => ''
                ])
                ,array([
                    'crumb_name' => 'Create Unit',
                    'crumb_link' => 'units-create'
                ])
            ]),
            'unit_id'   => $unit_id
        ));
    }
    public function postCreate(){
        $messages = array(
            'required_if'                           => 'The :attribute field is required',
            'not_in'                                => 'You have to choose a property type'
        );
        $validator = $this->validate($request, 
             array(
                 'price'                            => 'required',
                 'address'                          => 'required',
                 'commision_percentage'             => 'required',
                 'property_type'                    => 'not_in:10',
                 'area_1'                           => 'required_if:property_type,1,2,6,7,8,9',
                 'floor_1'                          => 'required_if:property_type,1,2,6,7,8,9',
                 'finish_1'                         => 'required_if:property_type,1,2,6,7,8,9',
                 'bedrooms_1'                       => 'required_if:property_type,1,2,6,7,8,9',
                 'bathrooms_1'                      => 'required_if:property_type,1,2,6,7,8,9',
                 'total_built_area_2'               => 'required_if:property_type,3,4,5',
                 'total_land_area_2'                => 'required_if:property_type,3,4,5',
                 'garden_area_2'                    => 'required_if:property_type,3,4,5',
                 'finish_2'                         => 'required_if:property_type,3,4,5',
                 'bedrooms_2'                       => 'required_if:property_type,3,4,5',
                 'bathrooms_2'                      => 'required_if:property_type,3,4,5',
                 'total_built_area_3'               => 'required_if:property_type,11',
                 'total_land_area_3'                => 'required_if:property_type,11',
                 'numner_of_floors_3'               => 'required_if:property_type,11',
                 'number_of_appartments_floor_3'    => 'required_if:property_type,11',
                 'number_of_elevators_3'            => 'required_with:elevator_3',
                 'area_4'                           => 'required_if:property_type,12',
                 'percentage_of_built_area_4'       => 'required_if:property_type,12',
                 'description'                      => 'max:5120'
             )
             , $messages
        );

        if($validator -> fails()) {
            return route('units-create')
                ->withErrors($validator)
                ->withInput();
        } else {
            //dd(Input::all());
            $unit_id                = Input::get('project_id');
            $district               = Input::get('district');
            $property_type          = Input::get('property_type');
            $price                  = Input::get('price');
            $property_status        = Input::get('property_status');
            $address                = Input::get('address');
            $commision_percentage   = Input::get('commision_percentage');
            $description            = Input::get('description');
            
            $user = auth()->user()->id;
            
            $unit;
            
            if($property_type == "1" || $property_type == "2" || $property_type == "9" || $property_type == "6" || $property_type == "7" || $property_type == "8"){
                $area_1             = Input::get('area_1');
                $floor_1            = Input::get('floor_1');
                $finish_1           = Input::get('finish_1');
                $bedrooms_1         = Input::get('bedrooms_1');
                $bathrooms_1        = Input::get('bathrooms_1');
                $garage_1           = Input::has('garage_1') ? true : false;
                $garden_1           = Input::has('garden_1') ? true : false;
                $roof_terrace_1     = Input::has('roof_terrace_1') ? true : false;
                $roof_1             = Input::has('roof_1') ? true : false;
                $elevator_1         = Input::has('elevator_1') ? true : false;
                
                $unit = Unit::create(array(
                    'property_id'           => $unit_id,
                    'property_type'         => $property_type,
                    'address'               => $address,
                    'district'              => $district,
                    'commision_percentage'  => $commision_percentage,
                    'description'           => $description,
                    'price'                 => $price,
                    'property_status'       => $property_status, 
                    'created_by'            => $user,
                    'marked_deleted'        => false,
                    'area'                  => $area_1,
                    'bathrooms'             => $bathrooms_1,
                    'bedrooms'              => $bedrooms_1,
                    'finish'                => $finish_1,
                    'floor'                 => $floor_1,
                    'garage'                => $garage_1,
                    'elevator'              => $elevator_1,
                    'garden'                => $garden_1,
                    'roof_terrace'          => $roof_terrace_1,
                    'roof'                  => $roof_1
                ));
            } else if($property_type == "3" || $property_type == "4" || $property_type == "5"){
                $total_built_area_2 = Input::get('total_built_area_2');
                $total_land_area_2  = Input::get('total_land_area_2');
                $garden_area_2      = Input::get('garden_area_2');
                $finish_2           = Input::get('finish_2');
                $bedrooms_2         = Input::get('bedrooms_2');
                $bathrooms_2        = Input::get('bathrooms_2');
                $garage_2           = Input::has('garage_2') ? true : false;
                $roof_terrace_2     = Input::has('roof_terrace_2') ? true : false;
                $elevator_2         = Input::has('elevator_2') ? true : false;
                
                $unit = Unit::create(array(
                    'property_id'           => $unit_id,
                    'property_type'         => $property_type,
                    'address'               => $address,
                    'district'              => $district,
                    'commision_percentage'  => $commision_percentage,
                    'description'           => $description,
                    'price'                 => $price,
                    'property_status'       => $property_status, 
                    'created_by'            => $user,
                    'marked_deleted'        => false,
                    'total_built_area'      => $total_built_area_2,
                    'total_land_area'       => $total_land_area_2,
                    'garden_area'           => $garden_area_2,
                    'finish'                => $finish_2,
                    'bathrooms'             => $bathrooms_2,
                    'bedrooms'              => $bedrooms_2,
                    'garage'                => $garage_2,
                    'elevator'              => $elevator_2,
                    'roof_terrace'          => $roof_terrace_2
                ));
            } else if($property_type == "11"){
                $total_built_area_3             = Input::get('total_built_area_3');
                $total_land_area_3              = Input::get('total_land_area_3');
                $numner_of_floors_3             = Input::get('numner_of_floors_3');
                $number_of_appartments_floor_3  = Input::get('number_of_appartments_floor_3');
                $number_of_elevators_3          = Input::get('number_of_elevators_3');
                $garage_3                       = Input::has('garage_3') ? true : false;
                $garden_3                       = Input::has('garden_3') ? true : false;
                $elevator_3                     = Input::has('elevator_3') ? true : false;
                
                $unit = Unit::create(array(
                    'property_id'                   => $unit_id,
                    'property_type'                 => $property_type,
                    'address'                       => $address,
                    'district'                      => $district,
                    'commision_percentage'          => $commision_percentage,
                    'description'                   => $description,
                    'price'                         => $price,
                    'property_status'               => $property_status, 
                    'created_by'                    => $user,
                    'marked_deleted'                => false,
                    'total_built_area'              => $total_built_area_3,
                    'total_land_area'               => $total_land_area_3,
                    'number_of_floors'              => $numner_of_floors_3,
                    'number_of_apartments_Floor'    => $number_of_appartments_floor_3,
                    'number_of_elevators'           => $number_of_elevators_3,
                    'garage'                        => $garage_3,
                    'elevator'                      => $elevator_3,
                    'garden'                        => $garden_3
                ));
            } else if($property_type == "12"){
                $area_4                         = Input::get('area_4');
                $percentage_of_built_area_4     = Input::get('percentage_of_built_area_4');
                
                $unit = Unit::create(array(
                    'property_id'                   => $unit_id,
                    'property_type'                 => $property_type,
                    'address'                       => $address,
                    'district'                      => $district,
                    'commision_percentage'          => $commision_percentage,
                    'description'                   => $description,
                    'price'                         => $price,
                    'property_status'               => $property_status, 
                    'created_by'                    => $user,
                    'marked_deleted'                => false, 
                    'total_land_area'               => $area_4,
                    'percentage_of_built_area'      => $percentage_of_built_area_4
                ));
            }
            
            if($unit){
                $submit = Input::get('submit');
                
                if($submit == "save"){
                    return route('units-view-single', array($unit->id));
                } else if($submit == "save-new"){
                    return route('units-create')
                        ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                } else {
                    return route('units-view')
                        ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                }
            }
        }
    }
    
    
    public function getSingle($id)
    {
        $user = auth()->user()->id;
        
        if(auth()->user()->userRole->view_all_units){
            $unit = Unit::where('id', $id)->first();
        } else {
            $unit = Unit::where('id', $id)->where('marked_deleted', false)->where('on_hold', false)->where('sold', false)->first();
            
            if(!$unit){
                $check = Unit::where('id', $id)->where('sold', true)->first();
                if($check){
                    $sold_by = $check->saleInfo->created_by;
                    if($sold_by == $user){
                        $unit = $check;
                    }
                }
            }
            
        }
                
        if($unit){
            
            $notes;
            if(auth()->user()->userRole->view_all_unit_notes){
                $notes = $unit->notes()->get();
            } else if(auth()->user()->userRole->view_unit_notes){
                $notes = $unit->notes()->where('marked_deleted', false)->get();
            } else {
                $notes = $unit->notes()->where('marked_deleted', false)->where('note_owner', $user)->get();
            }
            
            $add_note = auth()->user()->userRole->add_unit_note;
            
            PageTitle::add('View Unit Details');
            return view('units.singleview', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Units',
                        'crumb_link' => ''
                    ])
                    ,array([
                        'crumb_name' => 'View All',
                        'crumb_link' => 'units-view'
                    ])
                ]),
                'object'        => $unit,
                'model_type'    => 'Unit',
                'add_note'      => $add_note,
                'notes'         => $notes
            ));
        } else {
            return route('units-view')
                        ->with('error', '<strong>Errot!</strong> The Unit you are looking for doen\'t exist or the provided URL is invalid.');
        }
    }
    public function getModify($id){

        if(auth()->user()->userRole->view_all_units){
            $unit = Unit::where('id', $id)->first();
        } else {
            $unit = Unit::where('id', $id)->where('marked_deleted', false)->where('on_hold', false)->where('sold', false)->first();
        }
        
        if($unit){
            PageTitle::add('Individual Units');
            return view('units.modify', array(
                'breadcrumbs' => array([
                    array([
                        'crumb_name' => 'Units',
                        'crumb_link' => 'units-view'
                    ])
                    ,array([
                        'crumb_name' => 'Modify Unit',
                        'crumb_link' => ''
                    ])
                ]),
                'unit'  => $unit
            ));
        } else {
            return route('units-view')
                        ->with('error', '<strong>Errot!</strong> The Unit you are looking for doen\'t exist or the provided URL is invalid.');
        }
    }
    
    
    public function postModify($id){
        
        if(auth()->user()->userRole->view_all_units){
            $unit = Unit::where('id', $id)->first();
        } else {
            $unit = Unit::where('id', $id)->where('marked_deleted', false)->where('on_hold', false)->where('sold', false)->first();
        }
        
        if($unit){
            $messages = array(
            'required_if'                           => 'The :attribute field is required',
            'not_in'                                => 'You have to choose a property type'
            );
            $validator = $this->validate($request, 
                 array(
                     'price'                            => 'required',
                     'address'                          => 'required',
                     'commision_percentage'             => 'required',
                     'property_type'                    => 'not_in:10',
                     'area'                             => 'required_if:property_type,1,2,6,7,8,9',
                     'floor'                            => 'required_if:property_type,1,2,6,7,8,9',
                     'finish'                           => 'required_if:property_type,1,2,6,7,8,9',
                     'bedrooms'                         => 'required_if:property_type,1,2,6,7,8,9',
                     'bathrooms'                        => 'required_if:property_type,1,2,6,7,8,9',
                     'total_built_area'                 => 'required_if:property_type,3,4,5',
                     'total_land_area'                  => 'required_if:property_type,3,4,5',
                     'garden_area'                      => 'required_if:property_type,3,4,5',
                     'finish'                           => 'required_if:property_type,3,4,5',
                     'bedrooms'                         => 'required_if:property_type,3,4,5',
                     'bathrooms'                        => 'required_if:property_type,3,4,5',
                     'total_built_area'                 => 'required_if:property_type,11',
                     'total_land_area'                  => 'required_if:property_type,11',
                     'numner_of_floors'                 => 'required_if:property_type,11',
                     'number_of_appartments_floor'      => 'required_if:property_type,11',
                     'number_of_elevators'              => 'required_with:elevator_3',
                     'area'                             => 'required_if:property_type,12',
                     'percentage_of_built_area'         => 'required_if:property_type,12',
                     'description'                      => 'max:5120'
                 )
                 , $messages
            );

            if($validator -> fails()) {
                return route('units-modify-single', array($unit->id))
                    ->withErrors($validator)
                    ->withInput();
            } else {
                //dd(Input::all());
                $property_type = Input::get('property_type');
                
                $query = array(
                    'address'                       => Input::get('address'),
                    'area'	                        => null,
                    'bathrooms'	                    => null,
                    'bedrooms'	                    => null,
                    'commision_percentage'          => Input::get('commision_percentage'),
                    'description'	                => Input::get('description'),
                    'district'	                    => Input::get('district'),
                    'elevator'	                    => null,
                    'finish'	                    => null,
                    'floor'                         => null,
                    'garage'	                    => null,
                    'garden'	                    => null,
                    'garden_area'	                => null,
                    'last_updated'	                => null,
                    'marked_deleted'	            => null,
                    'number_of_apartments_Floor'    => null,
                    'number_of_elevators'           => null,
                    'number_of_floors'              => null,
                    'percentage_of_built_area'	    => null,
                    'price'	                        => Input::get('price'),
                    'property_status'	            => Input::get('property_status'),
                    'property_type'	                => $property_type,
                    'roof'	                        => null,
                    'roof_terrace'	                => null,
                    'total_built_area'	            => null,
                    'total_land_area'	            => null,
                    'updated_by'	                => auth()->user()->id
                );

                $op;

                if($property_type == "1" || $property_type == "2" || $property_type == "9" || $property_type == "6" || $property_type == "7" || $property_type == "8"){
                    $area_1             = Input::get('area');
                    $floor_1            = Input::get('floor');
                    $finish_1           = Input::get('finish');
                    $bedrooms_1         = Input::get('bedrooms');
                    $bathrooms_1        = Input::get('bathrooms');
                    $garage_1           = Input::has('garage') ? true : false;
                    $garden_1           = Input::has('garden') ? true : false;
                    $roof_terrace_1     = Input::has('roof_terrace') ? true : false;
                    $roof_1             = Input::has('roof') ? true : false;
                    $elevator_1         = Input::has('elevator') ? true : false;

                    $query['area']  = $area_1;
                    $query['bathrooms']  = $bathrooms_1;
                    $query['bedrooms']  = $bedrooms_1;
                    $query['finish']  = $finish_1;
                    $query['floor']  = $floor_1;
                    $query['garage']  = $garage_1;
                    $query['elevator']  = $elevator_1;
                    $query['garden']  = $garden_1;
                    $query['roof_terrace']  = $roof_terrace_1;
                    $query['roof']  = $roof_1;
                    
                    //dd($query);
                    
                    $op = $unit->update($query);
                    
                } else if($property_type == "3" || $property_type == "4" || $property_type == "5"){
                    $total_built_area_2 = Input::get('total_built_area');
                    $total_land_area_2  = Input::get('total_land_area');
                    $garden_area_2      = Input::get('garden_area');
                    $finish_2           = Input::get('finish');
                    $bedrooms_2         = Input::get('bedrooms');
                    $bathrooms_2        = Input::get('bathrooms');
                    $garage_2           = Input::has('garage') ? true : false;
                    $roof_terrace_2     = Input::has('roof_terrace') ? true : false;
                    $elevator_2         = Input::has('elevator') ? true : false;
                    
                    $query['total_built_area']  = $total_built_area_2;
                    $query['total_land_area']  = $total_land_area_2;
                    $query['garden_area']  = $garden_area_2;
                    $query['finish']  = $finish_2;
                    $query['bathrooms']  = $bathrooms_2;
                    $query['garage']  = $garage_2;
                    $query['elevator']  = $elevator_2;
                    $query['roof_terrace']  = $roof_terrace_2;
                    
                    $op = $unit->update($query);
                    
                } else if($property_type == "11"){
                    $total_built_area_3             = Input::get('total_built_area');
                    $total_land_area_3              = Input::get('total_land_area');
                    $numner_of_floors_3             = Input::get('numner_of_floors');
                    $number_of_appartments_floor_3  = Input::get('number_of_appartments_floor');
                    $number_of_elevators_3          = Input::get('number_of_elevators');
                    $garage_3                       = Input::has('garage') ? true : false;
                    $garden_3                       = Input::has('garden') ? true : false;
                    $elevator_3                     = Input::has('elevator') ? true : false;

                    $query['total_built_area']  = $total_built_area_3;
                    $query['total_land_area']  = $total_land_area_3;
                    $query['number_of_floors']  = $numner_of_floors_3;
                    $query['number_of_apartments_Floor']  = $number_of_appartments_floor_3;
                    $query['number_of_elevators']  = $number_of_elevators_3;
                    $query['garage']  = $garage_3;
                    $query['elevator']  = $elevator_3;
                    $query['garden']  = $garden_3;
                    
                    $op = $unit->update($query);
                    
                } else if($property_type == "12"){
                    $area_4                         = Input::get('area_4');
                    $percentage_of_built_area_4     = Input::get('percentage_of_built_area_4');
                    
                    $query['total_land_area']           = $area_4;
                    $query['percentage_of_built_area']  = $percentage_of_built_area_4;
                    
                    $op = $unit->update($query);
                }

                if($op){
                    $submit = Input::get('submit');

                    if($submit == "save"){
                        return route('units-view-single', array($unit->id));
                    } else if($submit == "save-new"){
                        return route('units-create')
                            ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                    } else {
                        return route('units-view')
                            ->with('success', '<strong>Congratulations!</strong> The new Unit has been created successfully.');
                    }
                }
            }
        } else {
            return route('units-view')
                        ->with('error', '<strong>Errot!</strong> The Unit you are looking for doen\'t exist or the provided URL is invalid.');
        }
    }
    
    public function postDelete($id){
        $unit = Unit::where('id', $id)->where('marked_deleted', false)->first();
        
        if($unit){
            $user = auth()->user()->id;
            $now_dt = date('Y-m-d H:i:s');
            $op = $unit->update(array(
                'marked_deleted'    => true,
                'deleted_by'        => $user,
                'deleted_at'        => $now_dt
            ));
            if($op){
                return route('units-view')
                    ->with('success', '<strong>Congratulations!</strong> The Intended Unit is Deleted successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Unit either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }
    
    public function postRestore($id){
        $unit = Unit::where('id', $id)->where('marked_deleted', true)->first();
        
        if($unit){
            $op = $unit->update(array(
                'marked_deleted'    => false,
                'deleted_by'        => null,
                'deleted_at'        => null
            ));
            if($op){
                return route('units-view-single', array($unit->id))
                    ->with('Success', '<strong>Congratulations!</strong> The Intended Unit is Restored successfully.');
            }
        } else {
            return Redirect::back()
                ->with('error', '<strong>Error!</strong> It Appears that the intended Unit either no longer exists, is already deleted or The URL Provided is invalid.');
        }
    }

}
