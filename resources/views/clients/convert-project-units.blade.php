@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-convert-step-post', array($lead->id, $project_id)) }}" method="post" class="form-horizontal" data-parsley-validate>
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
                                        <th>Unit Type</th>
                                        <th>Starting Price</th>
                                        <th>Unit Area</th>
                                        <th>Finishing</th>
                                        <th>Delivery Date</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($units as $unit)
                                    <tr>
                                        <td>{{ $unit->Type->label }}</td>
                                        <td>{{ number_format($unit->starting_price, 0) }} EGP</td>
                                        <td>{{ $unit->unit_area_from }} m<sub>2</sub> - {{ $unit->unit_area_to }} m<sub>2</sub></td>
                                        <td>{{ $unit->Finish->label }}</td>
                                        <td>{{ $unit->delivery_date }}</td>
                                        <td>
                                            <a href="{{ route('projects-view-single', array($project_id)) }}" target="_blank" class="btn btn-default btn-xs">View Project</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Type"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Starting Price"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Area"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Finishing"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Delivery Date"></th>
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
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Sold Unit Info</label>
                    </div>
                @if($errors->has('unit_area') || $errors->has('sold_price') || $errors->has('unit_type'))
                </div>
                <div class="row">
                    <div class="form-group has-error col-sm-12">
                    @else
                    <div class="text-danger col-sm-12">
                    @endif
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label" for="unit_type">Unit Type</label>
                                {{ Form::select('unit_type', $unit_types, old('unit_type'), array('id' => 'unit_type', 'class' => 'form-control input-sm')); }}
                                @if($errors->has('unit_type'))
                                <div class="help-block">{{ $errors->first('unit_type') }}</div>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label" for="unit_area">Unit Area</label>
                                <div class="form-control-group">
                                    <div class="input-group input-group-sm full-width">
                                        <input type="text" class="form-control unit_area" name="unit_area" id="unit_area" {{ (old('unit_area') ? '  value="'.e(old('unit_area')).'"' : '') }} data-parsley-required>
                                        <span class="input-group-addon">m<sub>2</sub></span>

                                    </div>
                                    @if($errors->has('unit_area'))
                                    <div class="help-block">{{ $errors->first('unit_area') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label" for="sold_price">Sold Price</label>
                                <div class="form-control-group">
                                    <div class="input-group input-group-sm full-width">
                                        <input type="text" class="form-control input-sm" name="sold_price" id="sold_price"{{ (old('sold_price') ? '  value="'.e(old('sold_price')).'"' : '') }} data-parsley-required>
                                        <span class="input-group-addon">EGP</span>
                                    </div>
                                    @if($errors->has('sold_price'))
                                    <div class="help-block">{{ $errors->first('sold_price') }}</div>
                                    @endif
                                </div>
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
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
    
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>


{{ asset('javascript/forms/singleview.js') }}
@stop