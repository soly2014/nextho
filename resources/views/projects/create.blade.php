@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('projects-create-post') }}" class="form-horizontal" method="post" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-home2 mr10"></i>Create A New Project</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        @if($errors->has('name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="name">Project Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="name" id="name"{{ (old('name') ? '  value="'.e(old('name')).'"' : '') }} data-parsley-required>
                                @if($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('district'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="district">Project District:</label>
                            <div class="col-sm-8">
                                {{ Form::select('district', $project_districts, old('district'), array('id' => 'district', 'class' => 'form-control input-sm')); }}
                                @if($errors->has('district'))
                                <div class="help-block">{{ $errors->first('district') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('commision'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="commision">Commision Percentage:</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm full-width">
                                    <input type="text" class="form-control input-sm" name="commision" id="commision"{{ (old('commision') ? '  value="'.e(old('commision')).'"' : '') }} data-parsley-required>
                                    <span class="input-group-addon input-sm">%</span>
                                </div>
                                @if($errors->has('commision'))
                                <div class="help-block">{{ $errors->first('commision') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($errors->has('delivery_date'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="delivery_date">Delivery Date:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control date-picker input-sm" name="delivery_date" id="delivery_date"{{ (old('delivery_date') ? '  value="'.e(old('delivery_date')).'"' : '') }} data-parsley-required>
                                @if($errors->has('delivery_date'))
                                <div class="help-block">{{ $errors->first('delivery_date') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('available'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="available">Available:</label>
                            <div class="col-sm-8">
                                <div class="checkbox custom-checkbox custom-checkbox-teal">
                                    <input type="checkbox" name="available" id="available" <?php if(old('available')== true) { echo 'checked="checked"'; } ?>> 
                                    <label for="available">&nbsp;&nbsp;Available</label>
                                </div>
                                @if($errors->has('available'))
                                <div class="help-block">{{ $errors->first('available') }}</div>
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
                    <div class="col-md-6">
                        @if($errors->has('description'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="description">Project Description:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" cols="5" name="description" id="description">{{ e(old('description')) }}</textarea>
                                @if($errors->has('description'))
                                <div class="help-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($errors->has('facilities'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="facilities">Project Facilities:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" cols="5" placeholder="Write One Per Line" name="facilities" id="facilities">{{ e(old('facilities')) }}</textarea>
                                @if($errors->has('facilities'))
                                <div class="help-block">{{ $errors->first('facilities') }}</div>
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
                        <a href="{{ route('projects-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
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

{{ asset('javascript/forms/singleview.js') }}

@stop