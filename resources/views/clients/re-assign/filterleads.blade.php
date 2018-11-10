@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-assign-filter-post') }}" method="post" class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-users3 mr10"></i>Filter Leads To Re Assign</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="assigned_to">Currently Assigned To:</label>
                            <div class="col-sm-8">
                                <select name="assigned_to[]" class="form-control input-sm" id="e1">
                                    @foreach($users as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>
                            </div>
                        </div>
{{--                         <div class="form-group">
                            <label class="col-sm-4 control-label" for="lead_source">Lead Source:</label>
                            <div class="col-sm-8">
                                <select name="lead_source[]" class="form-control input-sm" multiple>
                                    @foreach($lead_source as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="unit_types">Property Type Interested In:</label>
                            <div class="col-sm-8">
                                <select name="unit_types[]" class="form-control input-sm" multiple>
                                    @foreach($unit_types as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>                                                                
                            </div>
                        </div>
 --}}                    </div>
                    <div class="col-sm-6">
                        
{{--                         <div class="form-group">
                            <label class="col-sm-4 control-label" for="lead_status">Lead Status:</label>
                            <div class="col-sm-8">
                                <select name="lead_status[]" class="form-control input-sm" multiple>
                                    @foreach($lead_status as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>                                                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="unit_district">District Interested In:</label>
                            <div class="col-sm-8">
                                <select name="unit_district[]" class="form-control input-sm" multiple>
                                    @foreach($unit_district as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>                                                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="last_activity">Last Activity(Before):</label>
                            <div class="col-sm-8">
                                <input type="text" name="last_activity" id="last_activity" class="form-control full-date-picker input-sm">
                            </div>
                        </div>
 --}}                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="not_assigned_to">Assign Leads To:</label>
                            <div class="col-sm-8">
                                <select name="not_assigned_to" class="form-control input-sm" id="e2">
                                    @foreach($users as $k=>$v)
                                       <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach   
                                </select>                                                                
                                @if($errors->has('not_assigned_to'))
                                <div class="help-block text-danger">{{ $errors->first('not_assigned_to') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Process</button>
                        <a href="{{ route('leads-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">
        $("#e2,#e1").select2({
         placeholder: "Select a State",
         allowClear: true
    });

</script>
@stop