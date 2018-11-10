<div class="table-responsive panel-collapse pull out" style="">
    <table class="table table-bordered table-hover responsive" id="Leads_Table">
        <thead>
            <tr>
                <th>Lead Name</th>
                <th>Company</th>
                <th width="10%">Phone</th>
                <th>Email</th>
                <th>Created At</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($leads as $lead)
            <tr>
                <td><a href="{{ route('leads-view-single', array($lead->id)) }}">{{ $lead->name }} {{ $lead->last_name }}</a>
                    <?php
                    $length = '';
                    if ($lead->notes() && $lead->notes()->orderBy('updated_at','desc')->first()) {
                            $end = $lead->notes()->orderBy('updated_at','desc')->first()->updated_at;
                            $now = \Carbon\Carbon::now();
                            $length = $end->diffInDays($now);
                    }
                     ?> 
                    @if($length > 30)
                       <span class="label label-danger">Expired in {{ $length }} day</span>
                    @endif

                </td>
                <td>{{ $lead->company }}</td>
                <td>{{ ($lead->phone) ? $lead->phone : $lead->mobile }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->created_at }}</td>
                <td>
                    <div class="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('leads-modify-single', array($lead->id)) }}"><i class="icon ico-pencil"></i>Edit</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ route('leads-view-single', array($lead->id)) }}"><i class="icon ico-print3"></i>View</a>
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
                <th>
                    <input type="search" class="form-control" name="search_engine" placeholder="Lead Name">
                </th>
                <th>
                    <input type="search" class="form-control" name="search_engine" placeholder="Company">
                </th>
                <th>
                    <input type="search" class="form-control" name="search_engine" placeholder="Phone">
                </th>
                <th>
                    <input type="search" class="form-control" name="search_engine" placeholder="Email">
                </th>
                <th>
                    <input type="search" class="form-control" name="search_engine" placeholder="Created By">
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>