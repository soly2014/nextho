<div class="table-responsive panel-collapse pull out" style="">
    <table class="table table-bordered table-hover responsive datatable" id="open_activities_Table">
        <thead>
            <tr>
                <th>Activity Type</th>
                <th>Belongs To</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Modified Time</th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php $today = date('Y-m-d'); ?>
            @foreach($open_activities as $activity)
            <tr>
                <td>{{ $activity->activityType->label }}</td>
                @if($activity->clientBelongsTo->is_customer)
                    <td><a href="{{ route('customers-view-single', array($activity->clientBelongsTo->id)) }}">{{ $activity->clientBelongsTo->name }}</a></td>
                @else
                <td><a href="{{ route('leads-view-single', array($activity->clientBelongsTo->id)) }}">{{ $activity->clientBelongsTo->name }}</a></td>
                @endif
                <td>
                    {{ $activity->activityStatus->label }}
                    @if($activity->due_date < $today)
                        <span class="ml5 label label-danger">Past Due</span>
                    @endif
                </td>
                <td>{{ $activity->due_date }}</td>
                <td>{{ $activity->updated_at }}</td>
                <td width="10%">
                    <div class="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#"><i class="icon ico-pencil"></i>Edit</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ route('activity-close-post', array($activity->id)) }}"><i class="icon ico-print3"></i>Close</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Activity Type"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Belongs To"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Status"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Due Date"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Modified Time"></th> 
                <th width="10%"></th>
            </tr>
        </tfoot>
    </table>
</div>