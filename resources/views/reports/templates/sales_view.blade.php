@extends('common.master')

@section('breadcrumbs')
<div class="page-header-form">
    <form action="{{ route($form_route) }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="col-sm-5">
            {{ Form::text('start_date', $start_date, ['id' => 'start_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true', 'placeholder' =>'Start Date']) }}
        </div>
        <div class="col-sm-5">
            {{ Form::text('end_date', $end_date, ['id' => 'end_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true', 'placeholder'=> 'End Date']) }}
        </div>
        {{ csrf_field() }}
        <div class="col-sm-2">
            <button name="submit" type="submit" class="btn btn-primary btn-sm">Filter</button>
        </div>
    </form>
</div>
@stop

@section('content')

<div class="col-sm-12">
    <div class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-file mr10"></i>View Sales Report</h3>
            </div>
            <div class="table-responsive panel-collapse pull out" style="">
                <table class="table table-bordered table-hover responsive" id="Leads_Table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Client Name</th>
                            <th>Transaction Date</th>
                            <th>Client Source</th>
                            <th>Project/Unit Name</th>
                            <th>Unit Price</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Sold By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $counter = 0;
                        ?>
                        @foreach($sales as $sale)
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td>{{ $sale->Client->name }} {{ $sale->Client->last_name }}</td>
                            <td>{{ $sale->status_updated_at }}</td>
                            <td>{{ $sale->Client->source->label }}</td>
                            <?php
                                $transName;
                                $type = $sale->propertable_type;
                                if($type == 'Project'){
                                    $transName = $sale->Project->name;
                                } else {
                                    $transName = $sale->Unit->property_id;
                                }
                            ?>
                            <td><?php echo $transName ?></td>
                            <td>{{ number_format($sale->price, 0) }} EGP</td>
                            <td>{{ ($sale->Client->mobile) ? $sale->Client->mobile : $sale->Client->phone }}</td>
                            <td>{{ $sale->Client->street }}, {{ $sale->Client->city }}, {{ $sale->Client->country }}</td>
                            <td>{{ $sale->Client->work_title }}</td>
                            <td>{{ $sale->Client->company }}</td>
                            <td>{{ $sale->userCreated->username }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('styles')

{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }}
{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}
{{ asset('plugins/datatables/css/jquery.datatables.min.css') }}

@stop

@section('scripts')

{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}
{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}
{{ asset('plugins/datatables/js/jquery.datatables.min.js') }}
{{ asset('plugins/datatables/tabletools/js/tabletools.min.js') }}
{{ asset('plugins/datatables/tabletools/js/zeroclipboard.js') }}
{{ asset('plugins/datatables/js/jquery.datatables-custom.min.js') }}

{{ asset('javascript/forms/singleview.js') }}

@stop
