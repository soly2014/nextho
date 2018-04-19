@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

@include('users.partials.inactive')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-lock mr10"></i>Reset The User "{{ $user->username }}" Password</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route('users-password-reset-post', array($user->id)) }}" method="post" class="form-horizontal" data-parsley-validate>
        <!-- panel body with collapse capabale -->
            <div class="panel-body" id="reports">
                <div class="row">
                    <div class="col-sm-7">
                        @if($errors->has('password'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="password">New Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-sm" name="password" id="password" data-parsley-required data-parsley-minlength="6">
                                @if($errors->has('password'))
                                <div class="help-block mt10">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                        @if($errors->has('ReType_Password'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="ReType_Password">Re-Type New Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-sm" name="ReType_Password" id="ReType_Password" data-parsley-required data-parsley-minlength="6">
                                @if($errors->has('ReType_Password'))
                                <div class="help-block mt10">{{ $errors->first('ReType_Password') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        <!--/ panel body with collapse capabale -->
            {{ csrf_field() }}
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('users-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </form>
</div>

@stop

@section('scripts')
        
{{ asset('plugins/parsley/js/parsley.min.js') }}
{{ asset('javascript/utils/forms.js') }}   
@stop