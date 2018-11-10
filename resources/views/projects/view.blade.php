@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php $view = Auth::user()->userRole->view_projects ?>
<!--<div class="col-sm-12">
    <div class="panel-group" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" class="">
                        <i class="ico-search mr5"></i> Search
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
                
            </div>
        </div>    
    </div>
</div>-->
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-home2 mr10"></i>View All Projects</h3>
            <!-- panel toolbar -->
            <div class="panel-toolbar text-right">
                @if(Auth::user()->userRole->add_projects)
                <a href="{{ route('projects-create') }}" class="btn btn-sm btn-default"><i class="ico-home2"></i> Add New Project</a>
                @endif
            </div>
        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Project District</th>
                        <th>Starting Price</th>
                        <th>Area</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>
                            @if($view)
                                <a href="{{ route('projects-view-single', array($project->id)) }}">{{ $project->name }}</a>
                            @else
                                {{ $project->name }}
                            @endif
                            @if($project->marked_deleted)
                                - <span class="label label-danger">Deleted</span>
                            @endif
                        </td>
                        <td>{{ $project->District->label }}</td>
                        <td>{{ number_format($project->Units()->min('starting_price'), 0) }} EGP</td>
                        <td>{{ $project->Units()->min('unit_area_from') }} m<sub>2</sub> - {{ $project->Units()->max('unit_area_to') }} m<sub>2</sub></td>
                        <td>
                            <div class="toolbar">
                                @if(Auth::user()->userRole->modify_projects)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('projects-modify-single', array($project->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                            <li class="divider"></li>
                                            @if($view)
                                            <li><a href="{{ route('projects-view-single', array($project->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                @elseif($view)
                                    <a href="{{ route('projects-view-single', array($project->id)) }}" class="btn btn-default btn-xs">View Details</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project Districty"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Starting Price"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Area"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--/ panel body with collapse capabale -->
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