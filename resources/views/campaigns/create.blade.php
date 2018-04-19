@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('campaigns-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-stack3 mr10"></i>Create A New Campaign</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        @if($errors->has('name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="name">Campaign Name:</label>
                            <div class="col-sm-8">
                                <input type="text" id="name" name="name" class="form-control input-sm" data-parsley-required value="{{ old('name') }}">
                                @if($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('start_date'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="start_date">Start Date:</label>
                            <div class="col-sm-8">
                                <input type="text" id="start_date" name="start_date" class="form-control date-picker input-sm" data-parsley-required value="{{ old('start_date') }}">
                                @if($errors->has('start_date'))
                                <div class="help-block">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('end_date'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="end_date">End Date:</label>
                            <div class="col-sm-8">
                                <input type="text" id="end_date" name="end_date" class="form-control date-picker input-sm" value="{{ old('end_date') }}">
                                @if($errors->has('end_date'))
                                <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($errors->has('type'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label">Type:</label>
                            <div class="col-sm-9">
                                {{ Form::select('type', $campaign_type, old('type'), array('class' => 'form-control input-sm')); }}
                                @if($errors->has('type'))
                                <div class="help-block">{{ $errors->first('type') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('status'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label">Status:</label>
                            <div class="col-sm-9">
                                {{ Form::select('status', $campaign_status, old('status'), array('class' => 'form-control input-sm')); }}
                                @if($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">
                <div class="page-header no-border mb0">
                    <h3>Description Information</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->has('description'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="description">Description:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" rows="4" cols="5">{{ e(old('name')) }}</textarea>
                                @if($errors->has('description'))
                                <div class="help-block">{{ $errors->first('description') }}</div>
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
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <button name="submit" value="save-new" type="submit" class="btn btn-primary">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Save & Close</button>
                        <a href="{{ route('campaigns-view') }}" class="btn btn-danger">Cancel</a>
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

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>

@stop