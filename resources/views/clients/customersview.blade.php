@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title ellipsis" >Rejected Sales Reasons</div>
                        </div>
                        <div class="panel-body">

                                  <table class="table table-bordered table-hover responsive" id="simple_table">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Unit Type</th>
                                                <th>Price</th>
                                                <th>Area</th>
                                                <th>Created At</th>
                                                <th>Note</th>
                                                <th>marked seen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            @foreach(auth()->user()->soldProperties as $props)
                              @php $owner = $props->shared_with ? $props->shared_with  : $props->created_by;  @endphp
                              @if(!$props->comment_seen && $owner == auth()->user()->id && !$props->approved && !$props->pending)

                                            <tr><td>{{ $props->Client->name.' '.$props->Client->last_name }}</td>
                                                <td>{{ $props->saleInfo ? $props->saleInfo->Type->label : ''}}</td>
                                                <td>{{ $props->saleInfo ? number_format($props->saleInfo->sold_price, 0) : '' }} EGP</td>
                                                <td>{{ $props->saleInfo ? $props->saleInfo->unit_area : '' }}</td>
                                                <td>{{ $props->created_at }}</td>
                                                <td>{{ $props->comment }}</td>
                                                <td><a href="javascript:;" data-id="{{ $props->id }}" class="btn btn-info seen">Seen</a></td></tr>
                              @endif
                            @endforeach
                                        </tbody>
                                   </table>     
                        </div>
                    </div>
                </div>
            </div>  


<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-user22 mr10"></i>View All Customer</h3>
            <!-- panel toolbar -->
            <div class="panel-toolbar text-right">
                <a href="{{ route('leads-create') }}" class="btn btn-sm btn-default"><i class="ico-user-plus3"></i> Add New Lead</a>
            </div>
        </div>
        <!--/ panel heading/header -->



        <!-- panel body with collapse capabale -->
        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Company</th>
                        <th>Number of Sold Units</th>
                        <th>Sales Volume</th>
                        @if($view_all)
                        <th>Assigned To</th>
                        @endif
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td><a href="{{ route('customers-view-single', [$client->id]) }}">{{ $client->name }} {{ $client->last_name }}</a></td>
                        <td>{{ $client->company }}</td>
                        <td>{{ $client->propertiesCount }}</td>
                        <td>{{ number_format($client->propertiesAmount, 0) }} EGP</td>
                        @if($view_all)
                        <td>{{ $client->userAssigned->username }}</td>
                        @endif
                        <td>
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('leads-modify-single', array($client->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('customers-view-single', array($client->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Customer Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Number of Sold Units"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sales Volume"></th>
                        @if($view_all)
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Assigned To"></th>
                        @endif
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

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>
<script type="text/javascript">
            $('.seen').on('click',function () {
              var id = $(this).data('id');
              var c  = confirm('make comment seen');
              if (c) {
                $.ajax({
                    type:'POST',
                    url :'{{ route('mark.reject.seen') }}',
                    data:{id:id},
                    success:function(data){
                        if (data.success == true) {
                           location.reload();
                        }
                    }
                });
              }
        });


</script>

@stop