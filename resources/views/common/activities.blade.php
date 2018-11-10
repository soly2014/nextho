<div class="clearfix mb15">
    <div class="col-sm-12">
        <h3 class="thin-title"><a data-toggle="collapse" data-parent="#info" href="#open-activities" class="collapsed"> Open Activities</a></h3>
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
    $view       = Auth::user()->userRole->view_any_activity;
    $close      = Auth::user()->userRole->close_any_activity;
    $delete     = Auth::user()->userRole->delete_any_activity;
    $restore    = Auth::user()->userRole->restore_any_activities;

    $user = Auth::user()->id;
?>
        <div class="table-responsive panel-collapse pull out thin-table collapse in" id="open-activities">
            <table class="table table-bordered table-hover responsive actvities_table" id="Open_Activities_Table">
                <thead>
                    <tr>
                        <th>Activity Type</th>
                        <th>Due Date</th>
                        <th>Created By</th>
                        <th>Modified Time</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($open_activities as $activity)
                    <tr>
                        <td><a href="{{ route('activity-view-single', array($activity->id)) }}">{{ $activity->activityType->label }}</a>  
                            @if($activity->marked_deleted)
                            - <span class="label label-danger" title="{{ 'Deleted by '.$activity->userDeleted->username.' at '.$activity->deleted_at }}">Deleted</span>
                            @endif
                        </td>
{{--                         <td>{{ $activity->activityStatus->label }}</td>
--}}                        <td>{{ $activity->due_date }}
                            @if($activity->due_date < $today)
                                <span class="ml5 label label-danger">Past Due</span>
                            @endif
                        </td>
                        <td>{{ $activity->userCreated->username }}</td>
                        <td>{{ $activity->updated_at }}</td>
                        <td>
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if($modify || ($user == $activity->activity_owner))
                                            <li><a href="{{ route('activity-modify-single', array($activity->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        @endif
                                        @if($view || ($user == $activity->activity_owner))
                                        <li><a href="{{ route('activity-view-single', array($activity->id)) }}"><i class="icon ico-eye"></i>View</a></li>
                                        @endif
                                        @if($close || ($user == $activity->activity_owner))
                                        <li class="divider"></li>
                                        <li><a href="{{ route('activity-close-post', array($activity->id)) }}"><i class="icon ico-print3"></i>Close</a></li>
                                        @endif
                                        @if($delete || ($user == $activity->activity_owner))
                                            @if($activity->marked_deleted)
                                                @if($restore)
                                                    <li class="divider"></li>
                                                    <li><a href="{{ route('activity-restore-post', array($activity->id)) }}" class="text-primary confirm-restore-first"><i class="icon ico-loop2"></i>Restore</a></li>                                                    
                                                @endif
                                            @else
                                                <li class="divider"></li>
                                                <li><a href="{{ route('activity-delete-post', array($activity->id)) }}" class="text-danger warn-first"><i class="icon ico-trash"></i>Delete</a></li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="clearfix mb15">
    <div class="col-sm-12">
        <h3 class="thin-title"><a data-toggle="collapse" data-parent="#info" href="#closed-activities" class="collapsed"> Completed Activities</a></h3>
        <div class="table-responsive panel-collapse pull out thin-table collapse in" id="closed-activities">
            <table class="table table-bordered table-hover responsive actvities_table" id="Closed_Activities_Table">
                <thead>
                    <tr>
                        <th>Activity Type</th>
                        <th>Due Date</th>
                        <th>Closed By</th>
                        <th>Closed Time</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($completed_activities as $activity)
                    <tr>
                        <td><a href="{{ route('activity-view-single', array($activity->id)) }}">{{ $activity->activityType->label }}</a> 
                            @if($activity->marked_deleted)
                            - <span class="label label-danger" title="{{ 'Deleted by '.$activity->userDeleted->username.' at '.$activity->deleted_at }}">Deleted</span>
                            @endif
                        </td>
                        {{-- <td>{{ $activity->activityStatus->label }}</td>--}}                        <td>{{ $activity->due_date }}</td>
                        <td>{{ ($activity->userClosed) ? $activity->userClosed->username : "" }}</td>
                        <td>{{ $activity->closed_time }}</td>
                        <td>
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if($modify || ($activity->created_by == $activity->activity_owner))
                                            <li><a href="{{ route('activity-modify-single', array($activity->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        @endif
                                        
                                        @if($view || ($user == $activity->activity_owner))
                                            <li><a href="{{ route('activity-view-single', array($activity->id)) }}"><i class="icon ico-eye"></i>View</a></li>
                                        @endif
                                        
                                        @if($delete || ($activity->created_by == $activity->activity_owner))
                                            @if($activity->marked_deleted)
                                                @if($restore)
                                                <li class="divider"></li>
                                                <li><a href="{{ route('activity-restore-post', array($activity->id)) }}" class="text-primary confirm-restore-first"><i class="icon ico-loop2"></i>Restore</a></li>
                                                @endif
                                            @else
                                                <li class="divider"></li>
                                                <li><a href="{{ route('activity-delete-post', array($activity->id)) }}" class="text-danger warn-first"><i class="icon ico-trash"></i>Delete</a></li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(isset($add_activity) && $add_activity)
<form action="{{ route('activity-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
    <div class="bg-solid">
        <div class="clearfix">
            <div class="col-sm-6">
                @if($errors->has('activity_type'))
                <div class="form-group has-error">
                @else
                <div class="form-group">
                @endif
                    <label class="col-sm-3 control-label">Activity Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm" name="activity_type">
                            @foreach($activity_type as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('activity_type'))
                        <div class="help-block">{{ $errors->first('activity_type') }}</div>
                        @endif
                    </div>
                </div>
                @if($errors->has('due_date'))
                <div class="form-group has-error">
                @else
                <div class="form-group">
                @endif
                    <label class="col-sm-3 control-label" for="due_date">Due Date:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control date-picker input-sm" name="due_date" id="due_date" placeholder="Select A date" value="{{ old('due_date') }}" data-parsley-required/>
                        @if($errors->has('due_date'))
                        <div class="help-block">{{ $errors->first('due_date') }}</div>
                        @endif
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
                <div class="form-group">
                    <label class="col-sm-2 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ico-checkmark mr5"></i>Save</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="ico-close2 mr5"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </div>
</form>
@endif