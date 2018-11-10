@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
@include('units.partial.deleted')
<div class="col-sm-12">
    {{ Form::model($unit, ['method' => 'PUT', 'route' => ['units-modify-single-post', $unit->id], 'class' => 'form-horizontal modify-form', 'data-parsley-validate']) }}
        <div class="panel panel-default unit-form">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-office mr10"></i>Modify Individual Unit</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property ID:</label>
                            <div class="col-sm-8">
                                {{ Form::text('property_id', null, ['id' => 'property_id', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true', 'disabled' => 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property District:</label>
                            <div class="col-sm-8">
                                {{ Form::select('district', $districts, null, array('id' => 'district', 'class' => 'form-control input-sm')); }}
                                @if($errors->has('district'))
                                <div class="help-block">{{ $errors->first('district') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property Type:</label>
                            <div class="col-sm-8">
                                {{ Form::select('property_type', $types, null, array('id' => 'property_type', 'class' => 'form-control input-sm')); }}
                                @if($errors->has('property_type'))
                                <div class="help-block">{{ $errors->first('property_type') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="price">Price:</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm full-width">
                                    {{ Form::text('price', null, ['id' => 'price', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                    <span class="input-group-addon input-sm">EGP</span>
                                </div>
                                @if($errors->has('price'))
                                <div class="help-block">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="property_status">Property Status:</label>
                            <div class="col-sm-8">
                                {{ Form::select('property_status', $property_status, null, array('id' => 'property_status', 'class' => 'form-control input-sm')); }}
                                @if($errors->has('property_status'))
                                <div class="help-block">{{ $errors->first('property_status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="address">Address:</label>
                            <div class="col-sm-8">
                                {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                @if($errors->has('address'))
                                <div class="help-block">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="commision_percentage">Commision Percentage:</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm full-width">
                                    {{ Form::text('commision_percentage', null, ['id' => 'commision_percentage', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                    @if($errors->has('commision_percentage'))
                                    <div class="help-block">{{ $errors->first('commision_percentage') }}</div>
                                    @endif
                                    
                                    <span class="input-group-addon input-sm">%</span>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <hr class="dotted">
                <div class="page-header no-border mb0">
                    <h3>Property Information</h3>
                </div>
                <div class="holder">
                    <div id="information-container">
                        <div class="cat cat-0 row visible">
                            <p class="col-sm-12">
                                You Have to Choose a property type first
                            </p>
                        </div>
                        <div class="cat cat-1 row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="area_1">Area:</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-sm full-width">
                                            {{ Form::text('area', null, ['id' => 'area_1', 'class' => 'form-control input-sm']) }}
                                            <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                        </div>
                                        @if($errors->has('area'))
                                        <div class="help-block">{{ $errors->first('area') }}</div>
                                        @endif
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="floor_1">Floor:</label>
                                            <div class="col-sm-8">
                                                {{ Form::text('floor', null, ['id' => 'floor_1', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('floor'))
                                                <div class="help-block">{{ $errors->first('floor') }}</div>
                                                @endif
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="finish_1">Finish:</label>
                                            <div class="col-sm-8">
                                                {{ Form::select('finish', $finishs, null, array('id' => 'finish_1', 'class' => 'form-control input-sm')); }}
                                                @if($errors->has('finish'))
                                                <div class="help-block">{{ $errors->first('finish') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="bedrooms_1">Bedrooms:</label>
                                            <div class="col-sm-8">
                                                {{ Form::text('bedrooms', null, ['id' => 'bedrooms_1', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('bedrooms'))
                                                <div class="help-block">{{ $errors->first('bedrooms') }}</div>
                                                @endif
                                                
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="bathrooms_1">Bathrooms:</label>
                                            <div class="col-sm-8">
                                                {{ Form::text('bathrooms', null, ['id' => 'bathrooms_1', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('bathrooms'))
                                                <div class="help-block">{{ $errors->first('bathrooms') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('garage', 1, null, ['id' => 'garage1']) }}
                                                <label for="garage1">&nbsp;&nbsp;Garage</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('garden', 1, null, ['id' => 'garden_1']) }}
                                                <label for="garden_1">&nbsp;&nbsp;Garden</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('roof_terrace', 1, null, ['id' => 'roof_terrace_1']) }}
                                                <label for="roof_terrace_1">&nbsp;&nbsp;Roof Terrace</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('roof', 1, null, ['id' => 'roof_1']) }}
                                                <label for="roof_1">&nbsp;&nbsp;Roof</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('elevator', 1, null, ['id' => 'elevator_1']) }}
                                                <label for="elevator_1">&nbsp;&nbsp;Elevator</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cat cat-2 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="total_built_area_2">Total Built Area:</label>
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-sm full-width">
                                                {{ Form::text('total_built_area', null, ['id' => 'total_built_area_2', 'class' => 'form-control input-sm']) }}
                                                    <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                                </div>
                                                @if($errors->has('total_built_area'))
                                                <div class="help-block">{{ $errors->first('total_built_area') }}</div>
                                                @endif
                                                
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="total_land_area_2">Total Land Area:</label>
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-sm full-width">
                                                {{ Form::text('total_land_area', null, ['id' => 'total_land_area_2', 'class' => 'form-control input-sm']) }}
                                                    <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                                </div>
                                                @if($errors->has('total_land_area'))
                                                <div class="help-block">{{ $errors->first('total_land_area') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="garden_area_2">Garden Area:</label>
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-sm full-width">
                                                    {{ Form::text('garden_area', null, ['id' => 'garden_area_2', 'class' => 'form-control input-sm']) }}
                                                    <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                                </div>
                                                @if($errors->has('garden_area'))
                                                    <div class="help-block">{{ $errors->first('garden_area') }}</div>
                                                @endif
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="finish_2">Finish:</label>
                                            <div class="col-sm-12">
                                                {{ Form::select('finish', $finishs, null, array('id' => 'finish_2', 'class' => 'form-control input-sm')); }}
                                                @if($errors->has('finish'))
                                                <div class="help-block">{{ $errors->first('finish') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="bedrooms_2">Bedrooms:</label>
                                            <div class="col-sm-12">
                                                {{ Form::text('bedrooms', null, ['id' => 'bedrooms_2', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('bedrooms'))
                                                <div class="help-block">{{ $errors->first('bedrooms') }}</div>
                                                @endif
                                                
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="bathrooms_2">Bathrooms:</label>
                                            <div class="col-sm-12">
                                                {{ Form::text('bathrooms', null, ['id' => 'bathrooms_2', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('bathrooms'))
                                                <div class="help-block">{{ $errors->first('bathrooms') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('garage', 1, null, ['id' => 'garage_2']) }}
                                                <label for="garage_2">&nbsp;&nbsp;Garage</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('roof_terrace', 1, null, ['id' => 'roof_terrace_2']) }}
                                                <label for="roof_terrace_2">&nbsp;&nbsp;Roof Terrace</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('elevator', 1, null, ['id' => 'elevator_2']) }}
                                                <label for="elevator_2">&nbsp;&nbsp;Elevator</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cat cat-3 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="total_built_area_3">Total Built Area:</label>
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-sm full-width">
                                                {{ Form::text('total_built_area', null, ['id' => 'total_built_area_3', 'class' => 'form-control input-sm']) }}
                                                <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                                </div>
                                                @if($errors->has('total_built_area'))
                                                <div class="help-block">{{ $errors->first('total_built_area') }}</div>
                                                @endif
                                                
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="total_land_area_3">Total Land Area:</label>
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-sm full-width">
                                                {{ Form::text('total_land_area', null, ['id' => 'total_land_area_3', 'class' => 'form-control input-sm']) }}
                                                <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                                </div>
                                                @if($errors->has('total_land_area'))
                                                <div class="help-block">{{ $errors->first('total_land_area') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="numner_of_floors">Number Of Floors:</label>
                                            <div class="col-sm-12">
                                                {{ Form::text('numner_of_floors', null, ['id' => 'numner_of_floors', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('numner_of_floors'))
                                                <div class="help-block">{{ $errors->first('numner_of_floors') }}</div>
                                                @endif
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label text-left" for="number_of_appartments_floor_3">Number Of Appartments/Floor:</label>
                                            <div class="col-sm-12">
                                                {{ Form::text('number_of_appartments_floor', null, ['id' => 'number_of_appartments_floor_3', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('number_of_appartments_floor'))
                                                <div class="help-block">{{ $errors->first('number_of_appartments_floor') }}</div>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <br>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('garage', 1, null, ['id' => 'garage_3']) }}
                                                <label for="garage_3">&nbsp;&nbsp;Garage</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('garden', 1, null, ['id' => 'garden_3']) }}
                                                <label for="garden_3">&nbsp;&nbsp;Garden</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="checkbox custom-checkbox custom-checkbox-teal">
                                                {{ Form::checkbox('elevator', 1, null, ['id' => 'elevator_3']) }}
                                                <label for="elevator_3">&nbsp;&nbsp;Elevator</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left" for="number_of_elevators">Number Of Elevators(if any):</label>
                                            <div class="col-sm-7">
                                                {{ Form::text('number_of_elevators', null, ['id' => 'number_of_elevators', 'class' => 'form-control input-sm']) }}
                                                @if($errors->has('number_of_elevators'))
                                                <div class="help-block">{{ $errors->first('number_of_elevators') }}</div>
                                                @endif
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                        <div class="cat cat-4 row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="area_4">Area:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm full-width">
                                            {{ Form::text('area', null, ['id' => 'area_4', 'class' => 'form-control input-sm']) }}
                                            <span class="input-group-addon input-sm">m<sub>2</sub></span>
                                        </div>
                                        @if($errors->has('area'))
                                        <div class="help-block">{{ $errors->first('area') }}</div>
                                        @endif
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="percentage_of_built_area_4">Percentage of Built Area:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-sm full-width">
                                            {{ Form::text('percentage_of_built_area', null, ['id' => 'percentage_of_built_area_4', 'class' => 'form-control input-sm']) }}
                                            
                                            <span class="input-group-addon input-sm">%</span>
                                        </div>
                                        @if($errors->has('percentage_of_built_area'))
                                        <div class="help-block">{{ $errors->first('percentage_of_built_area') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">
                <div class="page-header no-border mb0">
                    <h3>Description Information</h3>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Project Description:</label>
                            <div class="col-sm-9">
                                {{ Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control input-sm', 'rows' => '4', 'cols' => '5', 'data-parsley-maxlength' => '5120']) }}
                                @if($errors->has('description'))
                                <div class="help-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <button name="submit" value="save-new" type="submit" class="btn btn-primary">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Save & Close</button>
                        <a href="{{ route('units-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }} 
</div>

@stop

@section('styles')

{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }}
{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}

@stop

@section('scripts')
{{ asset('plugins/parsley/js/parsley.min.js') }}
{{ asset('javascript/utils/forms.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}

{{ asset('javascript/forms/singleview.js') }}
{{ asset('javascript/utils/units.js') }}

@stop