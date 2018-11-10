@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<?php
    $email = $object;
?>
<?php 
    $send_any   = Auth::user()->userRole->send_all_email_templates; 
    $modify     = Auth::user()->userRole->modify_email_templates;
    $delete     = Auth::user()->userRole->delete_email_templates;

    
?>
<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-envelop mr10"></i>View Email Template Details</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        @if($email->published || $send_any)
                        <a href="{{ route('send-selected-email-post', array($email->id)) }}" class="btn btn-sm btn-default"><i class="ico-mail-send mr5"></i> Send Email</a>
                        @endif
                        @if($modify)
                        <a href="{{ route('emails-modify-single', array($email->id)) }}" class="btn btn-default btn-sm"><i class="ico-pencil"></i> Edit</a>
                        @endif
                        @if($delete)
                        @if($email->marked_deleted)
                        <a href="{{ route('emails-restore', array($email->id)) }}" class="btn btn-success btn-sm confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                        <a href="{{ route('emails-delete', array($email->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                        @endif
                    @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Template Name:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $email->template_name }}</label>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Activation Date:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $email->activation_date }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><a data-toggle="collapse" data-parent="#info" href="#details"><i class="ico-bubble-dots4 mr10"></i>Expand Extra Details</a></label>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Project:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $email->Project->name }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expiry Date:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $email->expiry_date }}</label>
                        </div>
                    </div>
                </div>
                <div id="details" class="panel-collapse collapse" style="height: auto;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email Title:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $email->email_title }}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email Body:</label>
                                <label class="col-sm-9 control-label control-label-value">{{ $email->email_body }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs in-panel">
                <li class="active"><a href="#attachments" data-toggle="tab">Attachments</a></li>
                <li class=""><a href="#notes" data-toggle="tab">Notes</a></li>
            </ul>
            <div class="tab-content in-panel">
                <div class="tab-pane " id="notes">
                    @include('common.notes')    
                </div>
                <div class="tab-pane active" id="attachments">
                    @include('common.attachments') 
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        @if($modify)
                        <a href="{{ route('emails-modify-single', array($email->id)) }}" class="btn btn-primary">Edit</a>
                        @endif
                        
                        @if($delete)
                        @if($email->marked_deleted)
                        <a href="{{ route('emails-restore', array($email->id)) }}" class="btn btn-success confirm-first"><i class="ico-checkbox-checked mr5"></i>Restore</a>
                            @else
                        <a href="{{ route('emails-delete', array($email->id)) }}" class="btn btn-danger warn-first"><i class="ico-cancel-circle mr5"></i>Delete</a>
                            @endif
                        @endif
                        <a href="{{ url()->previous('emails-view') }}" class="btn btn-danger">Cancel</a>
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
{{ asset('javascript/utils/general.js') }}
{{ asset('javascript/utils/project.js') }}

@stop