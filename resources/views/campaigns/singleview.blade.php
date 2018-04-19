@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php 

    $campaign = $object;
    $modify = Auth::user()->userRole->modify_campaigns;
    $delete = Auth::user()->userRole->delete_campaigns;
?>
@include('campaigns.partial.deleted')
<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-stack3 mr10"></i>View Campaign Deails</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        @if($modify)
                        <a href="{{ route('campaigns-modify-single', array($campaign->id)) }}" class="btn btn-default btn-sm"><i class="ico-pencil mr5"></i>Edit</a>
                        @endif
                        
                        @if($delete)
                            @if($campaign->marked_deleted)
                        <a href="{{ route('campaigns-restore', array($campaign->id)) }}" class="btn btn-success btn-sm confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                        <a href="{{ route('campaigns-delete', array($campaign->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Campaign Name:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $campaign->name }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Start Date:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $campaign->start_date }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">End Date:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $campaign->end_date }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><a data-toggle="collapse" data-parent="#info" href="#details"><i class="ico-bubble-dots4 mr10"></i>Expand Campaign Description</a></label>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Type:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $campaign->campaignType->label }}</label>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status:</label>
                            <label class="col-sm-9 control-label control-label-value">{{  $campaign->campaignStatus->label }}</label>

                        </div>
                    </div>
                </div>
                <div id="details" class="panel-collapse collapse" style="height: auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ e($campaign->description) }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs in-panel">
                @if($view_notes)
                <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
                @endif
                
                @if($view_activities)
                <li class=""><a href="#activities" data-toggle="tab">Activities</a></li>
                @endif
                
                @if($view_attachments)
                <li class=""><a href="#attachments" data-toggle="tab">Attachments</a></li>
                @endif
                
                @if($view_clients)
                <li class=""><a href="#leads-list" data-toggle="tab">Leads</a></li>
                @endif
            </ul>
            <div class="tab-content in-panel">
                @if($view_notes)
                <div class="tab-pane active" id="notes">
                    @include('common.notes')    
                </div>
                @endif
                
                @if($view_attachments)
                <div class="tab-pane" id="attachments">
                    @include('common.attachments') 
                </div>
                @endif
                
                @if($view_activities)
                <div class="tab-pane" id="activities">
                    @include('common.activities')    
                </div>
                @endif
                @if($view_clients)
                <div class="tab-pane" id="leads-list">
                    <div class="clearfix">
                        <div class="col-sm-12">
                            <div class="table-responsive panel-collapse pull out thin-table mb15" style="">
                                <table class="table table-bordered table-hover responsive" id="Leads_Table">
                                    <thead>
                                        <tr>
                                            <th>Lead Name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Client Type</th>
                                            <th>Member Status</th>
                                            <th>Added By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->company }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ ($client->is_customer) ? "Customer" : "Lead" }}</td>
                                            <td>{{ $client->pivot->member_status }}</td>
                                            <td>{{ $client->added_by }}</td>
                                            <td><a href="{{ route('campaign-lead-unlink-post', array($client->pivot->id)) }}" class="btn btn-danger btn-xs warn_first">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if($modify || $delete)
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        @if($modify)
                        <a href="{{ route('campaigns-modify-single', array($campaign->id)) }}" class="btn btn-primary">edit</a>
                        @endif
                        @if($delete)
                            @if($campaign->marked_deleted)
                            <a href="{{ route('campaigns-restore', array($campaign->id)) }}" class="btn btn-success confirm-first">Restore</a>
                            @else
                        <a href="{{ route('campaigns-delete', array($campaign->id)) }}" class="btn btn-danger warn-first">Delete</a>
                            @endif
                        @endif
                        <a href="{{ url()->previous('campaigns-view') }}" class="ml10 btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/javascript/utils/notes.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/campaign.js') }}"></script>

@stop