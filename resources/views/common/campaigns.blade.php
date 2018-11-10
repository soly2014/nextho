{{-- <div class="clearfix mb15">
    <div class="col-sm-12">
        <div class="table-responsive panel-collapse pull out thin-table collapse in" id="closed-activities">
            <table class="table table-bordered table-hover responsive" id="Closed_Activities_Table">
                <thead>
                    <tr>
                        <th>Campaign Name</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Member Status</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr>
                        <td><a href="{{ route('campaigns-view-single', array($campaign->id)) }}">{{ $campaign->name }}</a>
                            @if($campaign->pivot->marked_deleted)
                                <span class="ml5 label label-danger" title="{{ 'Deleted by '.$campaign->username.' at '.$campaign->pivot->deleted_at }}">Deleted</span>
                            @endif
                        </td>
                        <td>{{ $campaign->rel_status }}</td>
                        <td>{{ $campaign->rel_type }}</td>
                        <td>{{ $campaign->start_date }}</td>
                        <td>{{ $campaign->end_date }}</td>
                        <td>{{ $campaign->pivot->member_status}}</td>
                        <td>
                            @if($campaign->pivot->marked_deleted)
                            <a href="{{ route('campaign-lead-relink-post', array($campaign->pivot->id)) }}" class="btn btn-primary btn-xs confirm-restore-first">Restore</a>
                            @else
                            <a href="{{ route('campaign-lead-unlink-post', array($campaign->pivot->id)) }}" class="btn btn-danger btn-xs warn-first">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(isset($add_campaign) && $add_campaign)
<form action="{{ route('campaign-lead-link-post', array($lead->id)) }}" method="post" class="form-horizontal">
    <div class="bg-solid">
        <div class="form-group">
            <label class="col-sm-2 control-label mt15 pt15">Add Campaign:</label>
            <div class="col-sm-4">
                <label class="control-label">Campaign Name</label>
                <select name="compaign_id" class="form-control input-sm">
                    @foreach($all_campaigns as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Member Status</label>
                <select name="member_status" class="form-control input-sm">
                    @foreach($member_status as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary btn-sm"><i class="ico-stack3 mr5"></i>Add To Lead</button>
                <button type="reset" class="btn btn-danger btn-sm"><i class="ico-close2 mr5"></i>Reset</button>
            </div>
        </div>
    </div>
</form>
@endif --}}