@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-file mr10"></i>Add A New Parameter Item</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route($post) }}" method="post" class="form-horizontal" data-parsley-validate>
            <!-- panel body with collapse capabale -->
            <div class="panel-body" id="settings">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-left" for="label">Item Label:</label>
                            <div class="col-sm-9">
                                <input type="text" name="label" id="label" class="form-control input-sm" data-parsley-required>
                                @if($errors->has('label'))
                                <div class="help-block">{{ $errors->first('label') }}</div>
                                @endif

                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-6 control-label text-left" for="sort_order">Item Sort Order:</label>
                            <div class="col-sm-6">
                                <input type="text" name="sort_order" id="sort_order" class="form-control input-sm" data-parsley-required>
                                @if($errors->has('sort_order'))
                                <div class="help-block">{{ $errors->first('sort_order') }}</div>
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
                        <button type="submit" name="submit" value="save" class="btn btn-primary">Save</button>
                        <button type="submit" name="submit" value="save-new" class="btn btn-primary">Save & New</button>
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