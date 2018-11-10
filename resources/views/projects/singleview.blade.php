@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php 
    $project = $object;
    $edit = Auth::user()->userRole->modify_projects;
    $delete = Auth::user()->userRole->delete_projects;
    $add_unit = Auth::user()->userRole->add_project_units;
    $delete_unit = Auth::user()->userRole->delete_project_units;
    $modify_unit = Auth::user()->userRole->modify_project_units;

    $ui_notes = Auth::user()->userRole->view_project_ui_notes;
    $ui_emails = Auth::user()->userRole->view_project_ui_emails;
    $ui_units = Auth::user()->userRole->view_project_ui_units;
?>
@include('projects.partial.deleted')
<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-home2 mr10"></i>Project Details</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        @if($edit)
                        <a href="{{ route('projects-modify-single', array($project->id)) }}" class="btn btn-default btn-sm"><i class="ico-pencil mr5"></i>Edit</a>
                        @endif
                        @if($delete)
                            @if($project->marked_deleted)
                        <a href="{{ route('projects-restore', array($project->id)) }}" class="btn btn-success btn-sm confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                        <a href="{{ route('projects-delete', array($project->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Project Name:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $project->name }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Project District:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $project->District->label }}</label>
                        </div>
                        @if(Auth::user()->userRole->view_project_commission_persentage)
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Commision Percentage:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $project->commision_percentag }}%</label>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><a data-toggle="collapse" data-parent="#info" href="#details"><i class="ico-bubble-dots4 mr10"></i>Expand Extra Project Details</a></label>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Delivery Date:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $project->delivery_date }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Available:</label>
                            <div class="col-sm-8">
                                <div class="checkbox custom-checkbox custom-checkbox-teal">
                                    <input type="checkbox" name="available" id="available" <?php if($project->available == 1) { echo 'checked="checked"'; } ?> disabled> 
                                    <label for="available">&nbsp;&nbsp;Available</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="details" class="panel-collapse collapse" style="height: auto;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Description:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ e($project->description) }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Facilities:</label>
                                <label class="col-sm-9 control-label control-label-value">
                                    {{ e($project->facilities) }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs in-panel">
                @if($ui_units)
                <li class="active"><a href="#units-list" data-toggle="tab">Units</a></li>
                @endif
                @if($ui_emails)
                <li class=""><a href="#emails-list" data-toggle="tab">Emails</a></li>
                @endif
                @if($ui_notes)
                <li class=""><a href="#notes" data-toggle="tab">Notes</a></li>
                @endif
            </ul>
            <div class="tab-content in-panel">
                @if($ui_units)
                <div class="tab-pane active" id="units-list">
                    <div class="clearfix mb15">
                        <div class="col-sm-12">
                            <div class="table-responsive panel-collapse pull out thin-table collapse in" id="closed-activities">
                                <table class="table table-bordered table-hover responsive" id="Units_Table">
                                    <thead>
                                        <tr>
                                            <th>Unit Type</th>
                                            <th>Starting Price</th>
                                            <th>Unit Area</th>
                                            <th>Finishing</th>
                                            <th>Delivery Date</th>
                                            @if($modify_unit || $delete_unit)
                                            <th width="12%"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($units as $unit)
                                        <tr>
                                            <td>{{ $unit->Type->label }}
                                                @if($unit->marked_deleted)
                                                     - <span class="label label-danger" title="{{ 'Deleted By '.$unit->userDeleted->username }}">Deleted</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($unit->starting_price, 0) }} EGP</td>
                                            <td>{{ $unit->unit_area_from }} m<sub>2</sub> - {{ $unit->unit_area_to }} m<sub>2</sub></td>
                                            <td>{{ $unit->Finish->label }}</td>
                                            <td>{{ $unit->delivery_date }}</td>
                                            @if($modify_unit || $delete_unit)
                                            <td>
                                                @if($modify_unit)
                                                <a href="{{ route('unit-modify', array($project->id, $unit->id)) }}" class="btn btn-primary btn-xs">Edit</a>
                                                @endif
                                                @if($delete_unit)
                                                @if($unit->marked_deleted)
                                                <a href="{{ route('project-unit-restore', array($unit->id)) }}" class="confirm-first btn btn-success btn-xs">Restore</a>
                                                @else
                                                <a href="{{ route('project-unit-delete', array($unit->id)) }}" class="warn-first btn btn-danger btn-xs">Delete</a>
                                                @endif
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($add_unit)
                    <div class="bg-solid">
                        <div class="form-group no-border">
                            <label class="col-sm-3 control-label">Add New Unit</label>
                            <div class="col-sm-9">
                                <a href="{{ route('unit-create', $project->id) }}" class="btn btn-primary"><i class="ico-home2 mr5"></i>Add Unit</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                @if($ui_notes)
                <div class="tab-pane" id="notes">
                    @include('common.notes')
                </div>
                @endif
                @if($ui_emails)
                <div class="tab-pane" id="emails-list">
                    @include('projects.emails')
                </div>
                @endif
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        @if($edit)
                        <a href="{{ route('projects-modify-single', array($project->id)) }}" class="btn btn-primary">Edit</a>
                        @endif
                        
                        @if($delete)
                        @if($project->marked_deleted)
                        <a href="{{ route('projects-restore', array($project->id)) }}" class="btn btn-success confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                            <a href="{{ route('projects-delete', array($project->id)) }}" class="btn btn-danger warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                        <a href="{{ route('projects-view') }}" class="btn btn-danger ml10">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')

{{ asset('plugins/parsley/js/parsley.min.js') }}

{{ asset('javascript/utils/notes.js') }}
{{ asset('javascript/utils/project.js') }}
@stop