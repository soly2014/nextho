@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-convert-post', array($lead->id)) }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>Convert The Lead "{{ $lead->name }}"</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @include('clients.address-check')
                    <div class="col-sm-12">
                        <div class="table-responsive panel-collapse pull out" style="">
                            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Project ID</th>
                                        <th>Project Name</th>
                                        <th>Project District</th>
                                        <th>Delivery Date</th>
                                        <th>Starting Price</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $first = true ?>
                                    @foreach($units as $project)
                                    <tr>
                                        <th>
                                            <span class="radio custom-radio custom-radio-teal">  

                                                <input type="radio" name="selected_project" <?php if($first){ ?> data-parsley-required <?php } ?> data-parsley-mincheck="1" data-parsley-error-message="You have to choose a Unit to be able to procced." data-parsley-multiple="mymultiplelink" data-parsley-errors-container="#errors" id="{{ 'selected_project'.$project->id }}" value="{{ $project->id }}">
                                                <?php if($first == true) $first = false ?>
                                                <label for="{{ 'selected_project'.$project->id }}"></label>
                                            </span>
                                        </th>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->District->label }}</td>
                                        <td>{{ $project->delivery_date }}</td>
                                        <td>{{ number_format($project->Units()->min('starting_price'), 0) }} EGP</td>
                                        <td>
                                            <a href="{{ route('projects-view-single', array($project->id)) }}" target="_blank" class="btn btn-default btn-xs">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project ID"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project Name"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project District"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Delivery Date"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Starting Price"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div id="errors">
                                @if($errors->has('selected_project'))
                                <div class="help-block">{{ $errors->first('selected_project') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="property_type" value="{{ $type }}">
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Proceed</button>
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

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/parsley/js/parsley.min.js') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/javascript/utils/forms.js') }}">

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
@stop