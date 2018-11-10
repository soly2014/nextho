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
                            <th>Source Name</th>
                            <th>Clients #</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $counter = 0;
                        ?>
                        @foreach($clients as $client)
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td>{{ $client->source->label }}</td>
                            @if(isset($leads) && $leads)
		            <td>{{ $client->source->leadsCount}}</td>
                            <td><?php echo round((($client->source->leadsCount*100)/$clients_count), 2); ?>%</td>
		            @else
		            <td>{{ $client->source->customersCount }}</td>
                            <td><?php echo round((($client->source->customersCount *100)/$clients_count), 2); ?>%</td>
		            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th>Total</th>
                        <th>{{ $clients_count }}</th>
                        <th>100%</th>
                    </tfoot>
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