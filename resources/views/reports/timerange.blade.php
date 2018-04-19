@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-file mr10"></i>Choose The Report Date Range</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route($formRoute) }}" method="post" class="form-horizontal" data-parsley-validate>
        <!-- panel body with collapse capabale -->
        <div class="panel-body" id="reports-date-range">
            <div class="alert alert-info">
                <i class="ico-info2 mr5"></i>
                Specify a Date Range to generate the report
            </div>
                 <div class="row">
                     <div class="col-sm-6">
                         <div class="form-group">
                             <label class="col-sm-4 control-label" for="start_date">Start Date:</label>
                            <div class="col-sm-8">
                                {{ Form::text('start_date', null, ['id' => 'start_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true']) }}
                            </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <label class="col-sm-4 control-label" for="end_date">End Date:</label>
                            <div class="col-sm-8">
                                {{ Form::text('end_date', null, ['id' => 'end_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true']) }}
                            </div>
                        </div>
                     </div>
                 </div>
                 {{ csrf_field() }}
        </div>
        <!--/ panel body with collapse capabale -->
        <div class="panel-footer">
            <div class="form-group no-border">
                <label class="col-sm-3 control-label">Submit</label>
                <div class="col-sm-9">
                    <button name="submit" type="submit" class="btn btn-primary">Generate Report</button>
                    <a href="{{ route('reports-view') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
     </form>
    </div>

</div>

@stop

@section('styles')

{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }}
{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}

@stop

@section('scripts')

{{ asset('plugins/parsley/js/parsley.min.js') }}
{{ asset('javascript/utils/forms.js') }}

{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}

{{ asset('javascript/forms/singleview.js') }}

@stop