@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-file mr10"></i>Edit Developer</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route('developers.update',$developer->id) }}" method="post" class="form-horizontal" data-parsley-validate>
            <!-- panel body with collapse capabale -->{{ method_field('PUT') }}
            <div class="panel-body" id="settings">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-left" for="name">Developer Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control input-sm" value="{{ $developer->name }}" data-parsley-required>
                                @if($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif

                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
            <!--/ panel body with collapse capabale -->
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button type="submit" name="submit" value="save" class="btn btn-primary">Edit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>

@stop