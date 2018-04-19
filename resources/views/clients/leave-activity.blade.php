@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php $client = $object; ?>
<div class="col-sm-12">
    <form action="{{ route('activity-create-post', $client->id) }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>Leave Activity for "{{ $client->userAssigned->username }}"</h3>
            </div>
            <div class="panel-body">
                    <div class="clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Activity Type:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" name="activity_type">
                                        @foreach($activity_type as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                            @if($errors->has('due_date'))
                            <div class="form-group has-error">
                            @else
                            <div class="form-group">
                            @endif
                                <label class="col-sm-3 control-label" for="due_date">Due Date:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control date-picker input-sm" name="due_date" id="due_date" placeholder="Select A date"   value="{{ old('due_date') }}" data-parsley-required/>
                                    @if($errors->has('due_date'))
                                    <div class="help-block">{{ $errors->first('due_date') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" name="activity_status">
                                        @foreach($activity_status as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="priority">Priority:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" name="priority">
                                        @foreach($activity_priority as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-12">
                            @if($errors->has('description'))
                            <div class="form-group has-error">
                            @else
                            <div class="form-group">
                            @endif
                                <label class="col-sm-2 control-label" for="description">Description:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="4" cols="5" name="description" id="description">{{ old('description') }}</textarea>
                                    @if($errors->has('description'))
                                    <div class="help-block">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" value="{{ $model_type }}" name="activitable_type">
                            <input type="hidden" value="{{ $object->id }}" name="activitable_id">
                            <input type="hidden" value="{{ $client->assigned_to }}" name="activity_owner">
                        </div>
                    </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('leads-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        {{ csrf_field() }}
    </form>
</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
            
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/general.js') }}"></script>

@stop