@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

@include('users.partials.inactive')

<div class="col-md-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-users mr10"></i>View "{{ $user->username }}" Details</h3>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <a href="{{ route('users-modify-single', array($user->id)) }}" class="btn btn-default btn-sm"><i class="ico-pencil mr5"></i>Edit</a>
                        <a href="{{ route('users-password-reset', array($user->id)) }}" class="btn btn-default btn-sm"><i class="ico-lock mr5"></i>Password Reset</a>
                        @if($user->active)
                        <a href="{{ route('users-deactivate', array($user->id)) }}" class="btn btn-danger btn-sm warn-first"><i class="ico-cancel-circle mr5"></i>Deactivate</a>
                        @else
                        <a href="{{ route('users-reactivate', array($user->id)) }}" class="btn btn-success btn-sm warn-activate"><i class="ico-checkbox-checked mr5"></i>Reactivate</a>
                        @endif
                    </div>
                </div>
            </div>
            <!--/ panel heading/header -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User Name:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->username }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->email }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Created By:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->userCreated->username }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Created At:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->created_at }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Log-in:</label>
                            <label class="col-sm-8 control-label control-label-value">{{ $user->last_login }}</label>
                        </div>

                    </div>
                </div>
                @if($user->role_id == 2)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="table-layout">
                            <div class="col-xs-2 panel bgcolor-success">
                                <div class="ico-bars fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-10 panel">
                                <div class="panel-body text-center">
                                    <table class="semibold text-muted mb0 mt5 text-left table-prod" width="100%">
                                        <tr>
                                            <td>{{ number_format($sales_month, 0) }} EGP</td>
                                            <td>-</td>
                                            <td>{{ number_format($forecast_month, 0) }} EGP</td>
                                            <td>=</td>
                                            <td>{{ number_format(($forecast_month - $sales_month), 0) }} EGP</td>
                                            <td><span class="text-primary text-right">Monthly</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ number_format($sales_quarter, 0) }} EGP</td>
                                            <td>-</td>
                                            <td>{{ number_format($forecast_quarter, 0) }} EGP</td>
                                            <td>=</td>
                                            <td>{{ number_format(($forecast_quarter - $sales_quarter), 0) }} EGP</td>
                                            <td><span class="text-primary text-right">Quarterly</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ number_format($sales_year, 0) }} EGP</td>
                                            <td>-</td>
                                            <td>{{ number_format($forecast_year, 0) }} EGP</td>
                                            <td>=</td>
                                            <td>{{ number_format(($forecast_year - $sales_year), 0) }} EGP</td>
                                            <td><span class="text-primary text-right">Yearly</span></td>
                                        </tr>
                                    </table>
                                    <p class="semibold text-muted mb0 mt5">Total Sales</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="table-layout">
                            <div class="col-xs-2 panel bgcolor-success">
                                <div class="ico-stats-up fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-10 panel">
                                <div class="panel-body text-center">
                                    <table class="semibold text-muted mb0 mt5 text-left table-prod" width="100%">
                                        <tr>
                                            <td>{{ $monthly_actions }}</td>
                                            <td>-</td>
                                            <td>{{ $monthly_follow_ups }}</td>
                                            <td>=</td>
                                            <td>{{ $monthly_follow_ups - $monthly_actions }}</td>
                                            <td><span class="text-primary text-right">Monthly</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ $quarterly_actions }}</td>
                                            <td>-</td>
                                            <td>{{ $monthly_follow_ups*3 }}</td>
                                            <td>=</td>
                                            <td>{{ ($monthly_follow_ups*3) - $quarterly_actions }}</td>
                                            <td><span class="text-primary text-right">Quarterly</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ $yearly_actions }}</td>
                                            <td>-</td>
                                            <td>{{ $monthly_follow_ups*12 }}</td>
                                            <td>=</td>
                                            <td>{{ ($monthly_follow_ups*12) - $yearly_actions }}</td>
                                            <td><span class="text-primary text-right">Yearly</span></td>
                                        </tr>
                                    </table>
                                    <p class="semibold text-muted mb0 mt5">Follow Ups</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="table-layout fix-height">
                            <div class="col-xs-4 panel bgcolor-teal">
                                <div class="ico-users2 fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm">{{ $new_leads }}</h4>
                                    <p class="semibold text-muted mb0 mt5">Reassigned Leads With No Action</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <ul class="nav nav-tabs in-panel">
                <li class="active"><a href="#tab1" data-toggle="tab">Leads Assigned</a></li>
                <li class=""><a href="#tab4" data-toggle="tab">No Action Leads</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Customers</a></li>
                <li class=""><a href="#tab3" data-toggle="tab">Open Activities</a></li>
            </ul>
            <div class="tab-content in-panel">
                <div class="tab-pane active" id="tab1">
                    @include('users.partials.leads')
                </div>
                <div class="tab-pane" id="tab2">
                    @include('users.partials.customers')
                </div>
                <div class="tab-pane" id="tab3">
                    @include('users.partials.open_activities')
                </div>

                <div class="tab-pane" id="tab4">
                    @include('users.partials.no_action')
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <a href="{{ route('users-modify-single', array($user->id)) }}" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-primary mr10">Delete</button>
                        <a href="{{ route('users-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
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
<script type="text/javascript" src="{{ asset('public/javascript/utils/users.js') }}"></script>

@stop
