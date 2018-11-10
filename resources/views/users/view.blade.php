@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-users mr10"></i>View All Users</h3>
            <div class="panel-toolbar text-right">
                <a href="{{ route('users-create') }}" class="btn btn-sm btn-default"><i class="ico-user-plus"></i> Add New User</a>
            </div>
        </div>
        <!--/ panel heading/header -->

        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Last Log-in</th>
                        <th>Date Added</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{ route('users-view-single', array($user->id)) }}">{{ $user->username }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->userRole->role_name }}</td>
                            <td>
                                @if($user->active)
                                    <span class="label label-primary">Active</span>
                                @else
                                    <span class="label label-danger" title="Deactivated at {{ $user->deactivated_at }}">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $user->last_login }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">settings</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('users-view-single', array($user->id)) }}"><i class="icon ico-eye"></i>View</a></li>
                                            <li><a href="{{ route('users-modify-single', array($user->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                            <li><a href="{{ route('users-password-reset', array($user->id)) }}"><i class="icon ico-lock2    "></i>Reset Password</a></li>
                                            <li class="divider"></li>
                                            @if($user->active)
                                            <li><a href="{{ route('users-deactivate', array($user->id)) }}" class="text-danger warn-first"><i class="icon ico-cancel-circle"></i>Deactivate</a></li>
                                            @else
                                            <li><a href="{{ route('users-reactivate', array($user->id)) }}" class="text-success warn-reactivate"><i class="icon ico-checkbox-checked"></i>Reactivate</a></li>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Email"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Role"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Active"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Last Log-in"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Date Added"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
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

@stop