@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-pre-convert-post',$lead->id) }}" method="post" class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>Convert The Lead "{{ $lead->name }}"</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-3">
                        <button type="submit" value="Project" class="btn btn-default full-width-btn" name="submit">
                            <i class="ico-home2"></i>
                            <br/>
                            Project
                        </button>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" value="Unit" class="btn btn-default full-width-btn" name="submit">
                            <i class="ico-office"></i>
                            <br/>
                            Individual Unit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
</div>

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>

@stop