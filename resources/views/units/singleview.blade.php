@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php $unit = $object; $property_type = $unit->property_type; ?>
<?php 
$edit = Auth::user()->userRole->modify_units;
$delete = Auth::user()->userRole->delete_units;
?>
@include('units.partial.deleted')
<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-office mr10"></i>View Individual Unit Details</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                    @if($edit)
                    <a href="{{ route('units-modify-single', array($unit->id)) }}" class="btn btn-sm btn-default"><i class="ico-pencil"></i> Edit Unit</a>
                    @endif
                    @if($delete)
                        @if($unit->marked_deleted)
                            <a href="{{ route('units-restore', array($unit->id)) }}" class="btn btn-success btn-sm confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                        @else
                            <a href="{{ route('units-delete', array($unit->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                        @endif
                    @endif
                        </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property ID:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $unit->property_id }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property District:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $unit->District->label }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property Type:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $unit->Type->label }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Price:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ number_format($unit->price, 0) }} EGP</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Property Status:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $unit->property_status }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Address:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $unit->address }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-sm-12">
                        <hr class="dotted">
                        <div class="page-header no-border mb0">
                            <h3>Property Details</h3>
                        </div>
                        <div class="row">
                            <?php
    if($property_type == "1" || $property_type == "2" || $property_type == "9" || $property_type == "6" || $property_type == "7" || $property_type == "8"){
    ?>
        @include('units.categories.cat1')
    <?php } ?>
                            <?php 
if($property_type == "3" || $property_type == "4" || $property_type == "5"){
?>
                            @include('units.categories.cat2')
                            <?php
}
?>
                            <?php
if($property_type == "11"){
?>
                            @include('units.categories.cat3')
                            <?php } ?>
<?php
if($property_type == "12"){
?>
                            @include('units.categories.cat4')
                            <?php } ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><a data-toggle="collapse" data-parent="#info" href="#details"><i class="ico-bubble-dots4 mr10"></i>Expand Extra Unit Description</a></label>
                            
                        </div>
                        </div>
                    </div>
                </div>
                <div id="details" class="panel-collapse collapse" style="height: auto;">
                    <hr class="dotted">
                    <div class="page-header no-border mb0">
                        <h3>Description Information</h3>
                    </div>
                    <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Project Description:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ e($unit->description) }}</label>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <ul class="nav nav-tabs in-panel">
                <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
            </ul>
            <div class="tab-content in-panel">
                <div class="tab-pane active " id="notes">
                    @include('common.notes')
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        @if($edit)
                        <a href="{{ route('units-modify-single', array($unit->id)) }}" class="btn btn-primary">Edit</a>
                        @endif
                        @if($delete)
                            @if($unit->marked_deleted)
                                <a href="{{ route('units-restore', array($unit->id)) }}" class="btn btn-success confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                                <a href="{{ route('units-delete', array($unit->id)) }}" class="btn btn-danger warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                        <a href="{{ route('units-view') }}" class="btn btn-danger ml10">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('styles')

{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }}
{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}

@stop

@section('scripts')

{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}

{{ asset('javascript/forms/singleview.js') }}
{{ asset('javascript/utils/notes.js') }}
{{ asset('javascript/utils/project.js') }}

@stop