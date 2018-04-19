@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
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
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                </div>
            </div>
        </div>    
    </div>
</div>-->
<?php $edit = Auth::user()->userRole->modify_units ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-office mr10"></i>View All Individual Units</h3>
            <!-- panel toolbar -->
            <div class="panel-toolbar text-right">
                @if(Auth::user()->userRole->add_units)
                <a href="{{ route('units-create') }}" class="btn btn-sm btn-default"><i class="ico-office"></i> Add New Individual Unit</a>
                @endif
            </div>
        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Unit ID</th>
                        <th>Unit District</th>
                        <th>Unit Type</th>
                        <th width="10%">Status</th>
                        <th width="20%">Price</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                    <tr>
                        <td><a href="{{ route('units-view-single', array($unit->id)) }}">{{ $unit->property_id }}</a> 
                        @if($view_all)
                            @if($unit->on_hold)
                            <span class="label label-warning" title="{{ 'By '.$unit->saleInfo->userCreated->username }}">On Hold</span>
                            @endif
                            
                            @if($unit->sold)
                            <span class="label label-success" title="{{ 'By '.$unit->saleInfo->userCreated->username }}">Sold</span>
                            @endif
                            
                            @if($unit->marked_deleted)
                            <span class="label label-danger" title="{{ 'Deleted By '.$unit->userDeleted->username.' at '.$unit->deleted_at }}">Deleted</span>
                            @endif
                        @endif
                        </td>
                        <td>{{ $unit->District->label }}</td>
                        <td>{{ $unit->Type->label }}</td>
                        <td>{{ $unit->property_status }}</td>
                        <td>{{ number_format($unit->price, 0) }} EGP</td>
                        <td>
                            @if($edit)
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('units-modify-single', array($unit->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('units-view-single', array($unit->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                                    </ul>
                                </div>
                            </div>
                            @else
                                <a href="{{ route('units-view-single', array($unit->id)) }}" class="btn btn-default btn-xs">View Details</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit ID"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit District"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Status"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Price"></th>
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