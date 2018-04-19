@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php 
$priority = [
    "3" => "Normal",
    "5" => "Lowest",
    "4" => "Low",
    "2" => "High",
    "1" => "Highest"
];
$today = date('Y-m-d');
$modify     = Auth::user()->userRole->modify_any_activity;
$user       = Auth::user()->id;
?>
@if($activity->marked_deleted)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected Activity is deleted at {{ $activity->deleted_at }} - by <b>{{ $activity->userDeleted->username }}</b>, <a href="{{ route('activity-restore-post', array($activity->id)) }}">Restore Activity</a>
    </div>

</div>
@endif
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-stack3 mr10"></i>View Activity Deatils</h3>
        </div>
        <div class="form-horizontal">
            <div class="panel-body">
                    <div class="clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Activity Type:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $activity->activityType->label }}</label>
                            </div>                
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="due_date">Due Date:</label>
                                
                                <label class="col-sm-9 control-label control-label-value">{{ $activity->due_date }} 
                                    @if(($activity->due_date < $today) && ($activity->status != 4))
                                        <span class="ml5 label label-danger">Past Due</span>
                                    @endif
                                </label>
                            </div>    
                            @if(Auth::user()->userRole->view_any_activity)
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="due_date">Activity Owner:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $activity->owner->username }}</label>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6">

                            @if(Auth::user()->userRole->view_any_activity)
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="due_date">Created By:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $activity->userCreated->username }}</label>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="description">Description:</label>
                                <label class="col-sm-10 control-label control-label-value">{{ $activity->description }}</label>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        @if($activity->status == 4)
                            @if($modify || ($activity->created_by == $activity->activity_owner))
                                <a href="{{ route('activity-modify-single', array($activity->id)) }}" class="btn btn-primary">Modify</a>
                            @endif
                        @elseif($modify || ($user == $activity->activity_owner))
                            <a href="{{ route('activity-modify-single', array($activity->id)) }}" class="btn btn-primary">Modify</a>
                        @endif
                        @if($activity->status != 4)
                        <a href="{{ route('activity-close-post', array($activity->id)) }}" class="btn btn-primary">Close Activity</a>
                        @endif
                        <a href="{{ url()->previous('/') }}" class="ml10 btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop