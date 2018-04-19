@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-feed mr10"></i>View Forecast Details</h3>

        </div>
        <!--/ panel heading/header -->
        <div class="form-horizontal">
            <!-- panel body with collapse capabale -->
            <div class="panel-body" id="forecast">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Year:</label>
                        <label class="col-sm-9 control-label control-label-value">{{ $forecast->year }}</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Month:</label>
                        <label class="col-sm-9 control-label control-label-value">{{ $Months[$forecast->month] }}</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Role:</label>
                        <label class="col-sm-9 control-label control-label-value">{{ $forecast->associatedRole->role_name }}</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="amount">Amount:</label>
                        <label class="col-sm-9 control-label control-label-value">{{ number_format($forecast->amount, 0) }}</label>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <a href="{{ route('forecast-modify', array($forecast->id)) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('forecast-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>

@stop

@section('scripts')

{{ asset('plugins/parsley/js/parsley.min.js') }}

@stop