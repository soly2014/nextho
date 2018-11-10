@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
@if($activity->status == 4)
<div class="col-md-12">

    <div class="alert alert-info">
        <strong>Note, </strong> Tha the selected Activity is Marked as Completed at {{ $activity->closed_time }} - by <b>{{ ($activity->userClosed) ? $activity->userClosed->username : ''}}</b>
    </div>

</div>
@endif
<div class="col-sm-12">
    <form method="post" action="{{ route('activity-modify-single-post', $activity->id) }}" class="form-horizontal" data-parsley-validate>
        {{ method_field('PUT') }}{{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-compass mr10"></i>Modify Activity Details</h3>
            </div>
            <div class="panel-body">
                <div class="clearfix">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Activity Type:</label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm" name="type">
                                    @foreach($activity_type as $k=>$v)
                                      <option value="{{ $k }}" {{ $activity->type == $k ? 'selected' : '' }}>{{ $v }}</option>
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
                                <input type="text" name="due_date" value="{{ $activity->due_date }}" id="due_date" class="form-control input-sm date-picker" placeholder="Select a date" data-parsley-required="true">
                                @if($errors->has('due_date'))
                                <div class="help-block">{{ $errors->first('due_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
{{--                     <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status:</label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm" name="status">
                                    @foreach($activity_status as $k=>$v)
                                      <option value="{{ $k }}" {{ $activity->status == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
 --}}                </div>
                <div class="clearfix">
                    <div class="col-sm-12">
                        @if($errors->has('description'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-2 control-label" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control input-sm" rows="4" cols="5" data-parsley-maxlength="5120">{{ $activity->description }}</textarea>
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
                    <a href="{{ url()->previous('home') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/general.js') }}"></script>

@stop