@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-users mr10"></i>Modify The User "{{ $user->username }}" Information</h3>

        </div>
        <!--/ panel heading/header -->
        <form method="post" action="{{ route('users-modify-single-post', $user->id) }}" class="form-horizontal" data-parsley-validate>
            {{ method_field('PUT') }}
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
                                <input type="text" class="form-control input-sm" name="username" id="username" value="{{ $user->username }}" data-parsley-required>                                
                                @if($errors->has('username'))
                                <div class="help-block mt10">{{ $errors->first('username') }}</div>
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
                                <input type="text" class="form-control input-sm" name="email" id="email" value="{{ $user->email }}" data-parsley-required data-parsley-type="email">  
                                @if($errors->has('email'))
                                <div class="help-block mt10">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm" name="role">
                                    @foreach($roles as $k => $v)
                                    <option value="{{ $k }}" {{ $user->role_id == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('role_id'))
                                <div class="help-block mt10">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ panel body with collapse capabale -->
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