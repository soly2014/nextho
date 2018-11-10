@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-plus mr10"></i>Create A Forecast</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route('forecast-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
            <!-- panel body with collapse capabale -->
            <div class="panel-body" id="forecast">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Year <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{-- Form::select('year', $years, null, array('class' => 'form-control input-sm')); --}}
                            <select name="year" class="form-control input-sm">
                                @foreach($years as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('year'))
                            <div class="help-block mt10 text-danger">{{ $errors->first('year') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Month <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{-- Form::select('month', $Months, null, array('class' => 'form-control input-sm')); --}}
                            <select name="month" class="form-control input-sm">
                                @foreach($Months as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('month'))
                            <div class="help-block mt10 text-danger">{{ $errors->first('month') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">User <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{-- Form::select('role_id', $roles, null, array('class' => 'form-control input-sm')); --}}
                            <select name="agent_id" class="form-control input-sm">
                                @foreach(\App\Models\User::where('active', true)->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role_id'))
                            <div class="help-block mt10 text-danger">{{ $errors->first('role_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="amount">Amount <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-sm full-width">
                                {{-- Form::text('amount', null, ['id' => 'amount', 'class' => 'form-control input-sm', 'data-parsley-required']) --}}
                                <input type="text" name="amount" id="amount" class="form-control input-sm" data-parsley-required>
                                <span class="input-group-addon">EGP</span>
                            </div>
                            @if($errors->has('amount'))
                            <div class="help-block mt10 text-danger">{{ $errors->first('amount') }}</div>
                            @endif
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
                        <a href="{{ route('forecast-view') }}" class="btn btn-danger">Cancel</a>
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