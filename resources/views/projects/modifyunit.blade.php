@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
@include('projects.partial.deleted_unit')
<div class="col-sm-12">
    {{ Form::model($unit, ['method' => 'PUT', 'route' => ['unit-modify-post', $unit->project_id, $unit->id], 'class' => 'form-horizontal', 'data-parsley-validate']) }}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-home2 mr10"></i>Modify a Unit Details for the Project "{{ $unit->Project->name }}"</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @if($errors->has('unit_type') || $errors->has('unit_finish'))
                    <div class="form-group has-error">
                    @else
                    <div class="form-group">
                    @endif
                        <label class="col-sm-2 control-label mt15 pt15">Add To Project:</label>
                        <div class="col-sm-4">
                            <label class="control-label" for="unit_type">Unit Type</label>
                            {{ Form::select('unit_type', $unit_types, old('unit_type'), array('id' => 'unit_type', 'class' => 'form-control input-sm')); }}
                            @if($errors->has('unit_type'))
                            <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label" for="unit_finish">Unit Finishing</label>
                            {{ Form::select('unit_finish', $unit_finishs, old('unit_finish'), array('id' => 'unit_finish', 'class' => 'form-control input-sm')); }}
                            @if($errors->has('name'))
                            <div class="help-block">{{ $errors->first('unit_finish') }}</div>
                            @endif
                        </div>
                    </div>
                        
                    @if($errors->has('unit_area_from') || $errors->has('unit_area_to'))
                    <div class="form-group has-error">
                    @else
                    <div class="form-group text-danger">
                    @endif
                        <label class="col-sm-3 control-label">Unit Area</label>
                        <div class="col-md-7">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label" for="unit_area_from">From</label>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-sm full-width">
                                        {{ Form::text('unit_area_from', null, ['id' => 'unit_area_from', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                        <span class="input-group-addon">m<sub>2</sub></span>

                                    </div>
                                    @if($errors->has('unit_area_from'))
                                    <div class="help-block">{{ $errors->first('unit_area_from') }}</div>
                                    @endif
                                </div>

                                <label class="col-sm-2 control-label" for="unit_area_to">To</label>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-sm full-width">
                                        {{ Form::text('unit_area_to', null, ['id' => 'unit_area_to', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                        <span class="input-group-addon">m<sub>2</sub></span>
                                    </div>
                                    @if($errors->has('unit_area_to'))
                                    <div class="help-block">{{ $errors->first('unit_area_to') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('delivery_date') || $errors->has('starting_price'))
                    <div class="form-group has-error">
                    @else
                    <div class="form-group">
                    @endif
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="control-label col-sm-4 text-left" for="delivery_date">Delivery Date</label>
                                <div class="col-sm-8">
                                    {{ Form::text('delivery_date', null, ['id' => 'delivery_date', 'class' => 'form-control date-picker input-sm', 'data-parsley-required' => 'true']) }}
                                    
                                    @if($errors->has('delivery_date'))
                                    <div class="help-block">{{ $errors->first('delivery_date') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="control-label col-sm-4" for="starting_price">Starting Price</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm full-width">
                                        {{ Form::text('starting_price', null, ['id' => 'starting_price', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                        
                                        <span class="input-group-addon">EGP</span>
                                    </div>
                                    @if($errors->has('starting_price'))
                                    <div class="help-block">{{ $errors->first('starting_price') }}</div>
                                    @endif
                                </div>
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
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
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

@stop