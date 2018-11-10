@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-feed mr10"></i>View All Available Forcasts</h3>
            <div class="panel-toolbar text-right">
                <a href="{{ route('forecast-create') }}" class="btn btn-sm btn-default"><i class="ico-plus"></i> Add New Forecast</a>
            </div>
        </div>
        <!--/ panel heading/header -->

        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Amount</th>
                        <th>Agent</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($forecasts as $forecast)
                        <tr>
                            <td>{{ $Months[$forecast->month] }}</td>
                            <td>{{ $forecast->year }}</td>
                            <td>{{ number_format($forecast->amount, 0) }} EGP</td>
                            <td>{{ \App\Models\User::find($forecast->agent_id) ? \App\Models\User::find($forecast->agent_id)->username : '' }}</td>
                            <td>
                                <div class="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('forecast-modify', array($forecast->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('forecast-view-single', array($forecast->id)) }}"><i class="icon ico-print3"></i>View</a></li>
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

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>

@stop