@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
@include('clients.search')
<div class="col-md-12">
	<div class="panel panel-default">
		<!-- panel heading/header -->
		<div class="panel-heading">
			<h3 class="panel-title"><i class="ico-users3 mr10"></i>View All Leads</h3>
			<!-- panel toolbar -->
			<div class="panel-toolbar text-right">
				<a href="{{ route('leads-create') }}" class="btn btn-sm btn-default"><i class="ico-user-plus3"></i> Add New Lead</a>
			</div>
		</div>
		<!--/ panel heading/header -->
		@if($noaction_leads)
		<div class="col-sm-12">
			<h3 class="thin-title mt10">New Leads</h3>
		</div>
		<div class="table-responsive panel-collapse pull out" style="">
			<table class="table table-bordered table-hover responsive datatable" id="">
				<thead>
					<tr>
						<th>Lead Name</th>
						<th>Mobile</th>
						<th>Interested In(District)</th>
						<th>Category</th>
						<th>Intersted</th>
						<th>Created At</th>
						@if($view_all || auth()->user()->role_id == '3')
						<th width="15%">Assigned To</th>
						@endif
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach($noaction_leads as $lead)
					<tr>
						<td><a href="{{ route('leads-view-single', $lead->id) }}">{{ $lead->name }} {{ $lead->last_name }}</a>
							@if($lead->newly_assigned)
							- <span class="label label-warning">New Lead</span>
							@endif
							@if($lead->marked_deleted)
							- <span class="label label-danger" title="{{ 'Deleted by '.$lead->userDeleted->username.' at '.$lead->deleted_at }}">Deleted</span>
							@endif

						</td>
						<td>{{ $lead->mobile }}</td>
						<td>{{ $lead->district->label }}</td>
						<td>{{ $lead->cat }}</td>
						<td>{{ $lead->type->label }}</td>
						<td>{{ $lead->created_at }}</td>
						@if($view_all || auth()->user()->role_id == '3')
						<td>{{ $lead->userAssigned->username }}</td>
						@endif
						<td>
							<div class="toolbar">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ route('leads-modify-single', $lead->id) }}"><i class="icon ico-pencil"></i>Edit</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('leads-view-single', $lead->id) }}"><i class="icon ico-print3"></i>View</a></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<br />
		@endif
    </div>


		@if($converted)
		<div class="table-responsive panel-collapse pull out" style="">
			<table class="table table-bordered table-hover responsive {{ isset($pag) ? '' : 'datatable' }}" id="">
				<thead>
					<tr>
						<th>Lead Name</th>
						<th>Mobile</th>
						<th>Interested In(District)</th>
						<th>Category</th>
						<th>Intersted</th>
						<th>Created At</th>
						@if($view_all || auth()->user()->role_id == '3')
						<th width="15%">Assigned To</th>
						@endif
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach($converted as $lead)
					<tr>
						<td><a href="{{ route('leads-view-single', $lead->id) }}">{{ $lead->name }} {{ $lead->last_name }}</a>
							
							- <span class="label label-info">Converted</span>
							
							@if($lead->marked_deleted)
							- <span class="label label-danger" title="{{ 'Deleted by '.$lead->userDeleted->username.' at '.$lead->deleted_at }}">Deleted</span>
							@endif

						</td>
						<td>{{ $lead->mobile }}</td>
						<td>{{ $lead->district->label }}</td>
						<td>{{ $lead->cat }}</td>
						<td>{{ $lead->type->label }}</td>
						<td>{{ $lead->created_at }}</td>
						@if($view_all || auth()->user()->role_id == '3')
						<td>{{ $lead->userAssigned->username }}</td>
						@endif
						<td>
							<div class="toolbar">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ route('leads-modify-single', $lead->id) }}"><i class="icon ico-pencil"></i>Edit</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('leads-view-single', $lead->id) }}"><i class="icon ico-print3"></i>View</a></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{-- @if(isset($pag) && $pag)
			{{ $leads->appends(Request::except('page'))->links() }}
			@endif --}}
		</div>
		<!--/ panel body with collapse capabale -->
		@endif

         </br></br>
		<!-- panel body with collapse capabale -->
		<div class="table-responsive panel-collapse pull out" style="">
			<table class="table table-bordered table-hover responsive {{ isset($pag) ? '' : 'datatable' }}" id="">
				<thead>
					<tr>
						<th>Lead Name</th>
						<th>Mobile</th>
						<th>Interested In(District)</th>
						<th>Category</th>
						<th>Intersted</th>
						<th>Created At</th>
						@if($view_all || auth()->user()->role_id == '3')
						<th width="15%">Assigned To</th>
						@endif
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach($leads as $lead)
					<tr>
						<td><a href="{{ route('leads-view-single', $lead->id) }}">{{ $lead->name }} {{ $lead->last_name }}</a>
							@if($lead->newly_assigned)
							- <span class="label label-warning">No Action</span>
							@endif
							@if($lead->marked_deleted)
							- <span class="label label-danger" title="{{ 'Deleted by '.$lead->userDeleted->username.' at '.$lead->deleted_at }}">Deleted</span>
							@endif

						</td>
						<td>{{ $lead->mobile }}</td>
						<td>{{ $lead->district->label }}</td>
						<td>{{ $lead->cat }}</td>
						<td>{{ $lead->type->label }}</td>
						<td>{{ $lead->created_at }}</td>
						@if($view_all || auth()->user()->role_id == '3')
						<td>{{ $lead->userAssigned->username }}</td>
						@endif
						<td>
							<div class="toolbar">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
									<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ route('leads-modify-single', $lead->id) }}"><i class="icon ico-pencil"></i>Edit</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('leads-view-single', $lead->id) }}"><i class="icon ico-print3"></i>View</a></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{-- @if(isset($pag) && $pag)
			{{ $leads->appends(Request::except('page'))->links() }}
			@endif --}}
		</div></div>
		<!--/ panel body with collapse capabale -->


</div>
@stop

@section('styles')
<style type="text/css">
	.select2 {
				width:100%!important;
	}

</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }} ">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }} "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">
	
    $("#e2,#e1").select2({
         placeholder: "Select a State",
         allowClear: true
    });

</script>
@stop