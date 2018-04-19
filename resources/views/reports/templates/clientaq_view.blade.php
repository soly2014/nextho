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
                <h3 class="panel-title"><i class="ico-file mr10"></i>View Clients Acquisition Report</h3>
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
                        @if($projects_only)


                            @foreach($clients as $client)
                                @if($client->firstProperty->propertable_type == 'Project')
                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <td>{{ $client->name }} {{ $client->last_name }}</td>
                                    <td>{{ $client->customer_date }}</td>
                                    <td>{{ $client->source->label }}</td>
                                    <td>{{ $client->firstProperty->Project->name }}</td>
                                    <td>{{ number_format($client->firstProperty->price, 0) }} EGP</td>
                                    <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}</td>
                                    <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                                    <td>{{ $client->work_title }}</td>
                                    <td>{{ $client->company }}</td>
                                    <td>{{ $client->firstProperty->userCreated->username }}</td>
                                </tr>
                                @endif
                            @endforeach


                        @elseif($units_only)

                            @foreach($clients as $client)
                                @if($client->firstProperty->propertable_type == 'Unit')
                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <td>{{ $client->name }} {{ $client->last_name }}</td>
                                    <td>{{ $client->customer_date }}</td>
                                    <td>{{ $client->source->label }}</td>
                                    <td>{{ $client->firstProperty->Unit->property_id }}</td>
                                    <td>{{ number_format($client->firstProperty->price, 0) }} EGP</td>
                                    <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}</td>
                                    <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                                    <td>{{ $client->work_title }}</td>
                                    <td>{{ $client->company }}</td>
                                    <td>{{ $client->firstProperty->userCreated->username }}</td>
                                </tr>
                                @endif
                            @endforeach

                        @else
                            @foreach($clients as $client)
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td>{{ $client->name }} {{ $client->last_name }}</td>
                                <td>{{ $client->customer_date }}</td>
                                <td>{{ $client->source->label }}</td>
                                <?php
                                    $transName;
                                    $type = $client->firstProperty->propertable_type;
                                    if($type == 'Project'){
                                        $transName = $client->firstProperty->Project->name;
                                    } else {
                                        $transName = $client->firstProperty->Unit->property_id;
                                    }
                                ?>
                                <td><?php echo $transName ?></td>
                                <td>{{ number_format($client->firstProperty->price, 0) }} EGP</td>
                                <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}</td>
                                <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                                <td>{{ $client->work_title }}</td>
                                <td>{{ $client->company }}</td>
                                <td>{{ $client->firstProperty->userCreated->username }}</td>
                            </tr>
                            @endforeach
                        @endif
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
