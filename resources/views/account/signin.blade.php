@extends('account.master.layout')


@section('content')

<!-- Login form -->
<form class="panel" name="form-login" action="{{ route('account-sign-in-post') }}" method="post">
    <div class="panel-body">
        <!-- Alert message -->
        <div class="alert ">
            <span class="semibold">Note :</span>&nbsp;&nbsp;Type Below your username and password to log in.
        </div>
        <!--/ Alert message -->
        <div class="form-group">
            @if(Session::has('failed'))
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {!! Session::get('failed') !!}
            </div>
            @endif
            <div class="form-stack has-icon pull-left">
                <input name="email" type="text" class="form-control input-lg{{ ($errors->has('email')) ? ' parsley-error' : '' }}" placeholder="Email"{{ (old('email') ? '  value="'.e(old('email')).'"' : '') }}>
                <i class="ico-user2 form-control-icon"></i>
            </div><br>
            <div class="form-stack has-icon pull-left">
                <input name="password" type="password" class="form-control input-lg{{ ($errors->has('password')) ? ' parsley-error' : '' }}" placeholder="Password">
                <i class="ico-lock2 form-control-icon"></i>
            </div>
        </div>

        <!-- Error container -->
        <div id="error-container"class="mb15">
            @if($errors->has('email'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-custom-error-message">{{ $errors->first('email') }}</li>
            </ul>
            @endif
            
            @if($errors->has('password'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-custom-error-message">{{ $errors->first('password') }}</li>
            </ul>
            @endif
        </div>
        <!--/ Error container -->

        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkbox custom-checkbox custom-checkbox-teal">  
                        <input type="checkbox" name="remember" id="remember">  
                        <label for="remember">&nbsp;&nbsp;Remember me</label>   
                    </div>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="javascript:void(0);">Lost password?</a>
                </div>
            </div>
        </div>
        <div class="form-group nm">
            <button type="submit" class="btn btn-block btn-success"><span class="semibold">Sign In</span></button>
        </div>
    </div>
    {{ csrf_field() }}
</form>
<!-- Login form -->

@stop
