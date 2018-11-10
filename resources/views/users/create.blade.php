@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-user-plus mr10"></i>Create A New User</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route('users-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
        <!-- panel body with collapse capabale -->
            <div class="panel-body" id="reports">
                <div class="row">
                    <div class="col-sm-6">
                        @if($errors->has('username'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="username">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="username" id="username"{{ (old('username') ? '  value="'.e(old('username')).'"' : '') }} data-parsley-required>
                                @if($errors->has('username'))
                                <div class="help-block ">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>

                        @if($errors->has('email'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="email" id="email"{{ (old('email') ? '  value="'.e(old('email')).'"' : '') }} data-parsley-required data-parsley-type="email">
                                @if($errors->has('email'))
                                <div class="help-block ">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm" name="role">
                                    @foreach($roles as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('role'))
                                <div class="help-block ">{{ $errors->first('role') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($errors->has('password'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="password">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-sm" name="password" id="password" data-parsley-required data-parsley-minlength="6">
                                @if($errors->has('password'))
                                <div class="help-block ">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                        @if($errors->has('ReType_Password'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-4 control-label" for="ReType_Password">Re-Type Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control input-sm" name="ReType_Password" id="ReType_Password" data-parsley-required data-parsley-minlength="6">
                                @if($errors->has('ReType_Password'))
                                <div class="help-block ">{{ $errors->first('ReType_Password') }}</div>
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
                        <button name="submit" value="save-new" type="submit" class="btn btn-primary">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Save & Close</button>
                        <a href="{{ route('users-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </form>
</div>

@stop

@section('scripts')
        
<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
@stop