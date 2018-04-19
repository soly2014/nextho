@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-stack3 mr10"></i>View All Campaigns</h3>
            <!-- panel toolbar -->
            @if(Auth::user()->userRole->add_campaigns)
            <div class="panel-toolbar text-right">
                <a href="{{ route('campaigns-create') }}" class="btn btn-sm btn-default"><i class="ico-stack2 mr5"></i> Add New Campaign</a>
            </div>
            @endif
        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Campaign Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr>
                        <td><a href="{{ route('campaigns-view-single', array($campaign->id)) }}">{{ $campaign->name }}</a> 
                            @if($campaign->marked_deleted)
                                 - <span class="label label-danger" title="{{ 'By '.$campaign->userDeleted->username.' at '.$campaign->deleted_at }}">Deleted</span>
                            @endif
                        </td>
                        <td>{{ $campaign->campaignType->label }}</td>
                        <td>{{ $campaign->campaignStatus->label }}</td>
                        <td>{{ $campaign->start_date }}</td>
                        <td>{{ $campaign->end_date }}</td>
                        <td>
                            <div class="toolbar">
                                @if(Auth::user()->userRole->modify_campaigns)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('campaigns-modify-single', array($campaign->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('campaigns-view-single', array($campaign->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                                    </ul>
                                </div>
                                @else
                                <a href="{{ route('campaigns-view-single', array($campaign->id)) }}" class="btn btn-sm btn-default btn-xs">View Details</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Campaign Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Status"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Start Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="End Date"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--/ panel body with collapse capabale -->
    </div>

</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>

{{ asset('javascript/forms/singleview.js') }}

@stop