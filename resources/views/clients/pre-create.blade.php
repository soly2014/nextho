@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-pre-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Create A New Lead</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <b>Note, </b> in order for you to proceed with adding a new lead first you have to provide his Phone/Mobile Number
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="phone">Lead Mobile Number:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm" name="phone" id="phone"  data-parsley-type="number" data-parsley-minlength="11" data-parsley-maxlength="11">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="phone">International Number:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm" name="international_number" id="international_number"  data-parsley-type="number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="Proceed" type="submit" class="btn btn-primary">Proceed</button>
                        <a href="{{ route('leads-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        
        {{ csrf_field() }}
    </form>
</div>

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>

@stop
