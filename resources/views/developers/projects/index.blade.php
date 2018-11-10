@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default form-horizontal">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-cog mr10"></i>{{ $title }}</h3>
            <div class="panel-toolbar text-right">
                <a href="{{ route('newprojects.create') }}" class="btn btn-sm btn-default"><i class="ico-plus"></i> Add New Item</a>
            </div>
        </div>
        <!--/ panel heading/header -->

        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Developer Name</th>
                        <th>Published</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ \App\Models\Developer::find($item->developer_id)->name }}</td>
                            <td>
                                @if($item->published)
                                    <span class="label label-primary">Published</span>
                                @else
                                    <span class="label label-danger">Unpublished</span>
                                @endif
                            </td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('newprojects.edit', array($item->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                            <li class="divider"></li>
                                            @if($item->published)
                                                <li><a href="{{ url('newprojects/publish').'/'.$item->id.'/0' }}" class="text-danger warn-first"><i class="icon ico-eye-close"></i>Un-Publish</a></li>
                                            @else
                                            <li><a href="{{ url('newprojects/publish').'/'.$item->id.'/1'  }}" class="text-primary confirm-first"><i class="icon ico-eye"></i>Publish</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Item Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Published"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created At"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="panel-footer">
            <div class="form-group no-border">
                <label class="col-sm-3 control-label">Action</label>
                <div class="col-sm-9">
                    <a href="{{ route('parameters-view') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>

</div>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/params.js') }}"></script>

@stop