<div class="table-responsive panel-collapse pull out" style="">
    <table class="table table-bordered table-hover responsive datatable" id="">
        <thead>
            <tr>
                <th>Lead Name</th>
                <th>Interested In(District)</th>
                <th width="10%">Phone</th>
                <th>Created At</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($no_action_lead as $lead)
            <tr>
                <td><a href="{{ route('leads-view-single', array($lead->id)) }}">{{ $lead->name }} {{ $lead->last_name }}</a>
                    @if($lead->newly_assigned)
                    - <span class="label label-warning">No Action</span>
                    @endif
                    @if($lead->marked_deleted)
                    - <span class="label label-danger" title="{{ 'Deleted by '.$lead->userDeleted->username.' at '.$lead->deleted_at }}">Deleted</span>
                    @endif

                </td>
                <td>{{ $lead->district->label }}</td>
                <td>{{ ($lead->Phone) ? $lead->Phone : $lead->mobile }}</td>
                <td>{{ $lead->created_at }}</td>
                <td width="10%">
                    <div class="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('leads-modify-single', array($lead->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('leads-view-single', array($lead->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Lead Name"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Interested In(District)"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Phone"></th>
                <th ><input type="search" class="form-control" name="search_engine" placeholder="Created At"></th>
                <th width="10%"></th>
            </tr>
        </tfoot>
    </table>
</div>
