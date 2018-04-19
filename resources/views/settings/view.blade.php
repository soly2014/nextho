@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-equalizer mr10"></i>View All Parameters</h3>

        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        
        <div class="report-group">
            <div id="reports">
                <ul class="reports-container">
                    <li class="entry-head">
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-9">
                                    Parameter Name
                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Client Source</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-client-source-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Client Status</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-client-status-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Campaign Type</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-campaign-type-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Campaign Status</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-campaign-status-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Campaign-Member Status</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-campaign-member-status-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">District</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-district-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Unit Types</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-unit-type-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Unit Finishes</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-unit-finish-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Activity Types</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-activity-type-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Activity Status</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('parameters-activity-status-view') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Developers</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('developers.index') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Projects</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('newprojects.index') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="report-entry">
                            <div class="row">
                                <div class="col-sm-7">
                                    <span class="reporty-entity">Unit Places</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('unitplaces.index') }}" class="btn btn-default btn-xs">View Items</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body" id="reports">
        </div>
        <!--/ panel body with collapse capabale -->
    </div>

</div>

@stop
