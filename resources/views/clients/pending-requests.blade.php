@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php
$approved_list = false;
if(isset($approved) && $approved){
    $approved_list = $approved;
}
?>
 <div class="col-sm-12">
    <form action="{{ route('leads-confirm-post') }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>View Requests</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="thin-title">Projects</h3>
                        <div class="table-responsive panel-collapse pull out" style="">
                            <table class="table table-bordered table-hover responsive" id="simple_table">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        {{-- <th>Project Name</th> --}}
                                        <th>Unit Type</th>
                                        <th>Price</th>
                                        <th>Area</th>
                                        <th>Created By</th>
                                    
                                        <th>owner</th>
                                        <th>share qty</th>

                                        <th>Created At</th>
                                        @if(!$approved_list)
                                        {{-- <th width="15%">Action</th> --}}
                                        @else
                                        <th width="15%">Approval Status</th>
                                        {{-- <th width="5%"></th> --}}
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $first = true ?>
                                @foreach($projects as $transaction)
                                   @if(!is_null($transaction->unit_id) && !is_null($transaction->unit_id))
                                    <tr>
                                        @if($transaction->Client->is_customer == true)
                                        <td><a href="{{ route('customers-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @else
                                        <td><a href="{{ route('leads-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @endif

                                        <td><a href="{{ route('projects-view-single', array($transaction->Project->id)) }}" target="_blank">{{ $transaction->Project->name }}</a></td>
                                        <td>{{ $transaction->saleInfo->Type->label }}</td>
                                        <td>{{ number_format($transaction->saleInfo->sold_price, 0) }} EGP</td>
                                        <td>{{ $transaction->saleInfo->unit_area }} m<sub>2</sub></td>
                                        <td>{{ $transaction->userCreated->username }}</td>
                                        <td>{{ $transaction->shared_with != null ? \App\Models\User::find($transaction->shared_with)->username : '=======' }}</td>
                                        <td>{{ $transaction->shared_qty != null ? $transaction->shared_qty : '=======' }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        @if(!$approved_list)
                                           @if($transaction->shared_with == $transaction->created_by)
                                            <td rowspan="2">
                                                <a href="{{ route('leads-convert-single', array($transaction->id)) }}" class="btn btn-primary btn-xs confirm-first">Confirm</a>
                                                <a href="{{ route('leads-convert-reject-single', array($transaction->id)) }}" class="btn btn-danger btn-xs warn-first">Reject</a>
                                            </td>
                                            @endif
                                        @else
                                        <td>
                                            @if($transaction->approved)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <span class="label label-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('sales-modify-single', array($transaction->id)) }}" class="btn btn-default btn-xs">Modify</a>
                                        </td> --}}
                                        @endif
                                    </tr>
                                   {{-- new updates --}}
                                   @else
                                    <tr>
                                        @if($transaction->Client->is_customer == true)
                                        <td><a href="{{ route('customers-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @else
                                        <td><a href="{{ route('leads-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @endif

                                        <td>{{ $transaction->saleInfo ? $transaction->saleInfo->Type->label : ''}}</td>
                                        <td>{{ number_format($transaction->saleInfo->sold_price, 0) }} EGP</td>
                                        <td>{{ $transaction->saleInfo->unit_area }} m<sub>2</sub></td>
                                        <td>{{ $transaction->userCreated->username }}</td>
                                        <td>{{ $transaction->shared_with != null ? \App\Models\User::find($transaction->shared_with)->username : '=======' }}</td>
                                        <td>{{ $transaction->shared_qty != null ? $transaction->shared_qty : '=======' }}</td>

                                        <td>{{ $transaction->created_at }}</td>
                                        @if(!$approved_list)
                                           @if($transaction->shared_with == $transaction->created_by)
                                            <td rowspan="2">
                                                <a href="{{ route('leads-convert-single', array($transaction->id)) }}" class="btn btn-primary btn-xs confirm-first">Confirm</a>
                                                <a href="{{ route('leads-convert-reject-single', array($transaction->id)) }}" class="btn btn-danger btn-xs warn-first">Reject</a>
                                            </td>
                                            @endif
                                        @else
                                        <td>
                                            @if($transaction->approved)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <span class="label label-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        {{--<td>
                                             <a href="{{ route('sales-modify-single', array($transaction->id)) }}" class="btn btn-default btn-xs">Modify</a> 
                                        </td>--}}
                                        @endif
                                    </tr>
                                  @endif 
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br />
                    <div class="col-sm-12 mt15">
                        <h3 class="thin-title">Units</h3>
                        <div class="table-responsive panel-collapse pull out" style="">
                            <table class="table table-bordered table-hover responsive" id="simple_table">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Location</th>
                                        <th>Unit Type</th>
                                        <th>Price</th>
                                        <th>Created By</th>
                                        <th>Area</th>

                                        <th>owner</th>
                                        <th>share qty</th>


                                        <th>Created At</th>
                                        @if(!$approved_list)
                                        <th width="15%">Action</th>
                                        @else
                                        <th width="15%">Approval Status</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $first = true ?>
                                    @foreach($units as $transaction)

                                @if(!is_null($transaction->unit_id) && !is_null($transaction->unit_id))
                                    <tr>
                                        @if($transaction->Client->is_customer == true)
                                        <td><a href="{{ route('customers-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @else
                                        <td><a href="{{ route('leads-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @endif

                                        <td>{{ $transaction->saleInfo->Type->label }}</td>

                                        <td>{{ number_format($transaction->price, 0) }} EGP</td>
                                        <td>{{ $transaction->userCreated->username }}</td>

                                        <td>{{ $transaction->saleInfo->unit_area }} m<sub>2</sub></td>
                                        <td>{{ $transaction->shared_with != null ? \App\Models\User::find($transaction->shared_with)->username : '=======' }}</td>
                                        <td>{{ $transaction->shared_qty != null ? $transaction->shared_qty : '=======' }}</td>


                                        <td>{{ $transaction->created_at }}</td>
                                        @if(!$approved_list)
                                           @if($transaction->shared_with == $transaction->created_by)
                                            <td rowspan="2">
                                                <a href="{{ route('leads-convert-single', array($transaction->id)) }}" class="btn btn-primary btn-xs confirm-first">Confirm</a>
                                                <a href="{{ route('leads-convert-reject-single', array($transaction->id)) }}" class="btn btn-danger btn-xs warn-first">Reject</a>
                                            </td>
                                            @endif
                                        @else
                                        <td>
                                            @if($transaction->approved)
                                            <span class="label label-success">Approved</span>
                                            @else
                                            <span class="label label-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                {{-- new updates --}}
                                 @else   
                                    <tr>
                                        @if($transaction->Client->is_customer == true)
                                        <td><a href="{{ route('customers-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @else
                                        <td><a href="{{ route('leads-view-single', array($transaction->Client->id)) }}" target="_blank">{{ $transaction->Client->name }} {{ $transaction->Client->last_name }}</a></td>
                                        @endif
                                        <td><a href="#" target="_blank">{{ $transaction->location }}</a></td>

                                        <td>{{ $transaction->saleInfo->Type->label }}</td>
                                        <td>{{ number_format($transaction->price, 0) }} EGP</td>
                                                                            

                                        <td>{{ $transaction->userCreated->username }}</td>
                                      
                                        <td>{{ $transaction->saleInfo->unit_area }} m<sub>2</sub></td>
                                        <td>{{ $transaction->shared_with != null ? \App\Models\User::find($transaction->shared_with)->username : '=======' }}</td>
                                        <td>{{ $transaction->shared_qty != null ? $transaction->shared_qty : '=======' }}</td>


                                        <td>{{ $transaction->created_at }}</td>
                                        @if(!$approved_list)
                                           @if($transaction->shared_with == $transaction->created_by)
                                            <td rowspan="2">
                                                <a href="{{ route('leads-convert-single', array($transaction->id)) }}" class="btn btn-primary btn-xs confirm-first">Confirm</a>
                                                <a href="{{ route('leads-convert-reject-single', array($transaction->id)) }}" class="btn btn-danger btn-xs warn-first">Reject</a>
                                            </td>
                                            @endif
                                        @else
                                        <td>
                                            @if($transaction->approved)
                                            <span class="label label-success">Approved</span>
                                            @else
                                            <span class="label label-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                 @endif   

                           @endforeach
                                </tbody>
                            </table>
                            <div id="errors">
                                @if($errors->has('selected_unit'))
                                <div class="help-block">{{ $errors->first('selected_unit') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Process</button>
                        <a href="{{ route('leads-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
</div> 

@stop


@section('scripts')

<script type="text/javascript" src="{{ asset('public/javascript/forms/singleview.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/conversion.js') }}"></script>
@stop