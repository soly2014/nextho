@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-users mr10"></i>View All Roles</h3>
            <div class="panel-toolbar text-right">
                <a href="#" class="btn btn-sm btn-default"><i class="ico-user-plus"></i> Add New Role</a>
            </div>
        </div>
        <!--/ panel heading/header -->

        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Active</th>
                        <th>Users Count</th>
                        <th>Date Created</th>
                        <th>Created By</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->role_name }}</td>
                            <td>
                                @if($role->active)
                                    <label class="label label-primary">Active</label>
                                @else
                                    <label class="label label-danger">Inactive</label>
                                @endif
                            </td>
                            <td>{{ $role->usersCount }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->userCreated->username }}</td>
                            <td>
                                <div class="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">settings</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('users-view-single', array($role->id)) }}"><i class="icon ico-eye"></i>View</a></li>
                                            <li><a href="{{ route('users-modify-single', array($role->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('users-password-reset', array($role->id)) }}"><i class="icon ico-lock2    "></i>Reset Password</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Active"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Users Count"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Date Created"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

@stop

@section('styles')

{{ asset('plugins/datatables/css/jquery.datatables.min.css') }}

@stop

@section('scripts')

{{ asset('plugins/datatables/js/jquery.datatables.min.js') }}
{{ asset('plugins/datatables/tabletools/js/tabletools.min.js') }}
{{ asset('plugins/datatables/tabletools/js/zeroclipboard.js') }}
{{ asset('plugins/datatables/js/jquery.datatables-custom.min.js') }}
{{ asset('javascript/tables/datatable.js') }}

@stop