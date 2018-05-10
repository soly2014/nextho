@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/javascript/utils/notes.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/general.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/project.js') }}"></script>
@stop


@section('content')

<?php

$is_customer = false;
if(isset($customer) && $customer){
    $is_customer = $customer;
}

$lead = $object;

?>



<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user22 mr10"></i>"{{ $lead->name.' '.$lead->last_name }}" Details {{ $lead->newly_assigned }}</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <a href="{{ route('add.action', $lead->id) }}" class="btn btn-default confirm-first btn-sm"><i class="ico-refresh mr5"></i>Toggle Action</a>

                        <a href="{{ route('leads-modify-single', $lead->id) }}" class="btn btn-default btn-sm"><i class="ico-pencil mr5"></i>Edit</a>
                        @if($delete_action)
                            @if($lead->marked_deleted)
                        <a href="{{ route('client-restore', $lead->id) }}" class="btn btn-default confirm-first btn-sm"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                        <a href="{{ route('client-delete', $lead->id) }}" class="btn btn-default warn-first btn-sm"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                        <?php if(!$is_customer){ ?>
                        <a class="btn btn-primary btn-sm" href="{{ route('new.convert', $lead->id) }}"><i class="ico-refresh mr5"></i>Convert</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="info">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->title  }} {{ $lead->name }}</label>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Company:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->company ?? '======' }}</label>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->work_title != '' ? $lead->work_title : '========'}}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->Phone ?? '======'}}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mobile:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->mobile }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Developers:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ implode($lead->developers()->pluck('name')->toArray(),'|') }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Projects:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ implode($lead->projects()->pluck('name')->toArray(),'|') }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email:</label>
                            <label class="col-sm-9 control-label control-label-value"><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></label>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <span class="checkbox custom-checkbox custom-checkbox-teal">
                                            <input type="checkbox" name="customcheckbox2" id="customcheckbox2" <?php if($lead->opt_out == 1) { echo 'checked="checked"'; } ?> disabled/>
                                            <label for="customcheckbox2">&nbsp;&nbsp;Opt. Out</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if($view_all)
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Assigned To:</label>
                                    <label class="col-sm-7 control-label control-label-value">{{ $lead->userAssigned->username }}</label>
                                    <label class="col-sm-5 control-label">Created By:</label>
                                    <label class="col-sm-7 control-label control-label-value">{{ $lead->userCreated->username }}</label>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><a data-toggle="collapse" data-parent="#info" href="#details"><i class="ico-bubble-dots4 mr10"></i>Expand Extra Lead Information</a></label>

                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($lead->last_name != '')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Name:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->last_name }}</label>
                        </div>
                        @endif
                        @if($lead->fax != '')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fax:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->fax }}</label>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lead Source:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->source->label }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lead Status:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->status ? $lead->status->label : '' }}</label>
                        </div>
                        @if($lead->secondary_email != '')
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Secondary Email:</label>
                            <label class="col-sm-9 control-label control-label-value"><a href="mailto:{{ $lead->secondary_email }}">{{ $lead->secondary_email }}</a></label>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Category:</label>
                            <label class="col-sm-9 control-label control-label-value">{{ $lead->cat }}</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label text-left" for="interested_district">District Interested In:</label>
                                    <label class="col-sm-12 control-label control-label-value">{{ $lead->district->label }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label text-left" for="interested_type">Property Type Interested In:</label>
                                    <label class="col-sm-12 control-label control-label-value">{{ $lead->type->label }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="details" class="panel-collapse collapse">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Street:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $lead->street }}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $lead->state }}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $lead->country }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">City:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $lead->city }}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Zip Code:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ ($lead->zip_code != 0) ? $lead->zip_code : ''}}</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ e($lead->description) }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs in-panel">
                <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
                <li class=""><a href="#attachments" data-toggle="tab">Attachments</a></li>
                <li class=""><a href="#activities" data-toggle="tab">Activities</a></li>
                <?php if($is_customer) { ?>
                <li class=""><a href="#properties-list" data-toggle="tab">Properties</a></li>
                <?php } ?>
            </ul>
            <div class="tab-content in-panel">
                <div class="tab-pane active" id="notes">
                    @include('common.notes')
                </div>
                <div class="tab-pane" id="attachments">
                    @include('common.attachments')
                </div>
                <div class="tab-pane" id="activities">
                    @include('common.activities')
                </div>
                @if($is_customer)
                <div class="tab-pane" id="properties-list">
                    @include('common.properties')
                </div>
                @endif
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                            <a href="{{ route('leads-modify-single', $lead->id) }}" class="btn btn-primary">Edit</a>
                            <?php if(!$is_customer){ ?>
                            <a class="btn btn-primary" href="{{ route('leads-pre-convert', $lead->id) }}">Convert</a>
                            <?php } ?>
                            @if($delete_action)
                                @if($lead->marked_deleted)
                                    <a href="{{ route('client-restore', $lead->id) }}" class="btn btn-success confirm-first">Restore</a>
                                @else
                                    <a href="{{ route('client-delete', $lead->id) }}" class="btn btn-danger warn-first">Delete</a>
                                @endif
                            @endif
                            <?php if(!$is_customer){ ?>
                        <?php } ?>

                        <a href="{{ url()->previous() }}" class="btn btn-danger ml10">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
