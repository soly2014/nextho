@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form class="form-horizontal" action="{{ route('emails-create-post')}}" method="post" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Create A New Email Template</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        @if($errors->has('template_name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="template_name">Template Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="template_name" id="template_name" data-parsley-required value="{{ old('template_name') }}">
                                @if($errors->has('template_name'))
                                <div class="help-block">{{ $errors->first('template_name') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('activation_date'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="activation_date">Activation Date:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control date-picker input-sm" value="<?php echo date('m/d/y'); ?>" name="activation_date" id="activation_date" data-parsley-required value="{{ old('activation_date') }}">
                                @if($errors->has('activation_date'))
                                <div class="help-block">{{ $errors->first('activation_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($errors->has('project'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="project">Project:</label>
                            <div class="col-sm-8">
                                {{ Form::select('project', $projects_list, old('project'), array('class' => 'form-control input-sm')); }}
                                @if($errors->has('project'))
                                <div class="help-block">{{ $errors->first('project') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('expiry_date'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="expiry_date">Expiry Date:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control date-picker input-sm" value="{{ old('expiry_date') }}" name="expiry_date" id="expiry_date">
                                <span class="checkbox custom-checkbox custom-checkbox-teal">
                                    <input type="checkbox" name="expiry_date_never" id="expiry_date_never" <?php if(old('expiry_date_never')== true) { echo 'checked="checked"'; } ?>>
                                    <label for="expiry_date_never">&nbsp;&nbsp;Never</label>
                                </span>
                                @if($errors->has('expiry_date'))
                                <div class="help-block">{{ $errors->first('expiry_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($errors->has('email_title'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-2 control-label" for="email_title">Email Title:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="email_title" id="email_title" value="{{ old('email_title') }}" data-parsley-required>
                                @if($errors->has('email_title'))
                                <div class="help-block">{{ $errors->first('email_title') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('email_body'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-2 control-label" for="email_body">Email Body:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="10" cols="5" placeholder="Paste The Template HTML" name="email_body" id="email_body" data-parsley-required>{{ old('email_body') }}</textarea>
                                @if($errors->has('email_body'))
                                <div class="help-block">{{ $errors->first('email_body') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <button name="submit" value="save-new" type="submit" class="btn btn-primary">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Save & Close</button>
                        <a href="{{ route('emails-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@stop

@section('styles')

{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }}
{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}

@stop

@section('scripts')
{{ asset('plugins/parsley/js/parsley.min.js') }}
{{ asset('javascript/utils/forms.js') }}
                        
{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}

{{ asset('plugins/ck/ckeditor.js') }}
                        
{{ asset('javascript/forms/singleview.js') }}
{{ asset('javascript/utils/email_templates.js') }}

@stop