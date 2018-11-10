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
        <form action="{{ route('post.change.password') }}" method="post" class="form-horizontal" data-parsley-validate>
        <!-- panel body with collapse capabale -->
            <div class="panel-body" id="reports">
                <div class="row">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="password">password <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control input-sm" name="password_update" placeholder="123456" data-parsley-minlength="6" data-parsley-maxlength="25" >
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
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Update</button>
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