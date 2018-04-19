@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-file mr10"></i>View All Reports</h3>

        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        <div class="panel-body" id="reports">
            <div class="report-group">
                <div id="reports">
                    <ul class="reports-container">
                        <li class="entry-head">
                            <div class="report-entry">
                                <div class="row">
                                    <div class="col-sm-4">
                                        Report Name
                                    </div>
                                    <div class="col-sm-3">
                                        Last Generated At
                                    </div>
                                    <div class="col-sm-2">
                                        Generated #
                                    </div>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        @foreach($reports as $report)
                        <li>
                            <div class="report-entry">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="reporty-entity">{{ $report->report_name }}</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="reporty-entity">{{ $report->last_generated_at }}</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="reporty-entity">{{ $report->number_generated }}</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{ route('reports-generate-single', array($report->id)) }}" class="btn btn-default btn-xs">Generate</a> <a href="{{ route(($report->route.'-view-get')) }}" class="btn btn-default btn-xs">View</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <li>
                            <div class="report-entry">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="reporty-entity">Daily Performance</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-3">
										<a href="{{ route('report-daily-repot-get') }}" class="btn btn-default btn-xs">Generate</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <li>
                            <div class="report-entry">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="reporty-entity">Clients Attributes</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-3">
										<a href="{{ route('report-clients-attr-get') }}" class="btn btn-default btn-xs">Generate</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="report-entry">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="reporty-entity">DB_exports</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="reporty-entity">--</span>
                                    </div>
                                    <div class="col-sm-3">
										<a href="{{ route('db-export-single') }}" class="btn btn-default btn-xs">Generate</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ panel body with collapse capabale -->
    </div>

</div>

@stop