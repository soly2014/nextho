@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-convert-step-post', array($lead->id, $conversion->id)) }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>Convert The Lead "{{ $lead->name }}"</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive panel-collapse pull out" style="">
                            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Unit Type</th>
                                        <th>Starting Price</th>
                                        <th>Unit Area</th>
                                        <th>Finishing</th>
                                        <th>Delivery Date</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $first = true ?>
                                    @foreach($units as $unit)
                                    <tr>
                                        <th>
                                            <span class="radio custom-radio custom-radio-teal">  
                                                
                                                <input type="radio" name="selected_unit" <?php if($first){ ?> data-parsley-required <?php } ?> data-parsley-mincheck="1" data-parsley-error-message="You have to choose a Unit to be able to procced." data-parsley-multiple="mymultiplelink" data-parsley-errors-container="#errors" id="{{ 'selected_unit'.$unit->id }}" value="{{ $unit->id }}">
                                                <?php if($first == true) $first = false ?>
                                                <label for="{{ 'selected_unit'.$unit->id }}"></label>
                                            </span>
                                        </th>
                                        <td>{{ $unit->Type->label }}</td>
                                        <td>{{ number_format($unit->starting_price, 0) }} EGP</td>
                                        <td>{{ $unit->unit_area_from }} m<sub>2</sub> - {{ $unit->unit_area_to }} m<sub>2</sub></td>
                                        <td>{{ $unit->Finish->label }}</td>
                                        <td>{{ $unit->delivery_date }}</td>
                                        <td>
                                            <a href="{{ route('projects-view-single', array($conversion->project_id)) }}" target="_blank" class="btn btn-default btn-xs">View Project</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit ID"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit District"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Type"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Status"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Price"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div id="errors">
                                @if($errors->has('selected_unit'))
                                <div class="help-block">{{ $errors->first('selected_unit') }}</div>
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

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
@stop