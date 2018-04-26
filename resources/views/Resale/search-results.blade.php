@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

@include('resale.partials.search')
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-feed mr10"></i>View All Resales</h3>
            <div class="panel-toolbar text-right">
                <a href="{{ route('resales.create') }}" class="btn btn-sm btn-default"><i class="ico-plus"></i> Add New Resale</a>
            </div>
        </div>
        <!--/ panel heading/header -->
        
        <div class="table-responsive panel-collapse pull out text-center">
            <table class="table table-bordered table-hover responsive text-center" id="Leads_Table">
                <thead> 
                    <tr class="text-center">
                        <th  class="text-center">ID</th>
                        <th  class="text-center">Sale Type</th>
                        <th  class="text-center">Unit Now</th>
                        <th  class="text-center">Agent Name</th>
                        <th  class="text-center">Type</th>
                        <th  class="text-center">Finish</th>
                        <th  class="text-center">Location</th>
                        <th  class="text-center">Project Name</th>
                        <th  class="text-center">B.U.A</th>
                        <th  class="text-center">Land</th>
                        <th  class="text-center">Price</th>
                        <th  class="text-center">D.Pay</th>
                        <th  class="text-center">T.Fees</th>
                        <th  class="text-center">Buyer Co.</th>
                        <th  class="text-center">T.P</th>
                        <th  class="text-center">T.D</th>
                        <th  class="text-center">Installment</th>
                        <th  class="text-center">Notes</th>
                        <th  class="text-center" width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($resales as $resale)
                        <tr>
                            <td>{{ $resale->id }}</td>
                            <td>{{ ucfirst($resale->sale_type) }}</td>
                            <td>{{ ucfirst($resale->unit_now) }}</td>
                            <td>{{ \App\Models\User::find($resale->created_by)->username }}</td>
                            <td>{{ \App\Models\UnitType::find($resale->property_type)->label }}</td>
                            <td>{{ \App\Models\Finish::find($resale->status)->label }}</td>
                            <td>{{ \App\Models\ProjectDistrict::find($resale->location_id)->label }}</td>
                            <td>{{ \App\Models\ParameterProject::find($resale->project_id)->name }}</td>
                            <td>{{ $resale->built_up_area }}</td>
                            <td>{{ $resale->land_area }}</td>
                            <td>{{ $resale->unit_price }}</td>
                            <td>{{ $resale->down_payment }}</td>
                            <td>{{ $resale->phase }}</td>
                            <td>{{ $resale->phase }}</td>
                            <td>{{ $resale->land_area }}</td>
                            <td>{{ camel_case($resale->unit_now) }}</td>
                            <td>{{ camel_case($resale->unit_now) }}</td>
                            <td>{{ camel_case($resale->installment) }}</td>
                            <td>
                               @if(auth()->user()->role_id == '1')
                                    <span data-toggle="tooltip" title="Edit!"><a href="{{ route('resales.edit',$resale->id) }}" class="btn btn-primary " style="margin-bottom: 3px;"><i class="icon ico-pencil"></i> </a></span>
                                  @if($resale->approved)
                                   <span data-toggle="tooltip" title="Dis-Approve!"><a href="{{ route('resales.approve',[$resale->id,0]) }}" class="btn btn-danger"><i class="icon ico-print3"></i></a></span>
                                  @else
                                   <span data-toggle="tooltip" title="Approve!"><a href="{{ route('resales.approve',[$resale->id,true]) }}" class="btn btn-info"><i class="icon ico-print3"></i></a></span>
                                  @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">
<style type="text/css">
    table.th {  text-align: center; }
</style>
@stop

@section('scripts')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

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