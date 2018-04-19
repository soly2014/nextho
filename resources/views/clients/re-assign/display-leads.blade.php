@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
@include('clients.re-assign.search')

<div class="col-sm-12">

     <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs in-panel">
                    <li class="active"><a href="{{ route('leads-assign-selection') }}">Leads </a></li>
                </ul>
            <form action="{{ route('leads-assign-selection-post') }}" method="post" class="form-horizontal" data-parsley-validate>
                <div class="tab-content in-panel">
                    <div class="tab-pane active" id="tab1">
                        <table class="table table-bordered table-hover responsive datatable" id="Leads">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Lead Name</th>
                                    <th>Phone Number</th>
                                    <th>Assigned To</th>
                                    <th>Lead Source</th>
                                    <th>Lead Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="non_searchable"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="non_searchable"></td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
        </div>
    </div>
</div class="col-sm-12">


<div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-users3 mr10"></i>Filter Leads To Re Assign &nbsp;&nbsp;&nbsp;&nbsp;
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive panel-collapse pull out clearfix" style="">




                    <input type="hidden" value="{{ $assign_to }}" name="assign_to">
                    <div id="errors">
                        @if($errors->has('leads'))
                        <div class="help-block">{{ $errors->first('leads') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                          <span class="checkbox" style="display: inline-grid;">
                         <input type="checkbox" id="chkAll" style="width: 30px;height: 30px;" name="all"><label for=""></label></span>
                        </div>                        
                        <label class="col-sm-2 control-label">Transfer Without: </label>
                        <div class="col-sm-2">
                            <span class="checkbox custom-checkbox custom-checkbox-teal">
                                <input id="notes" name="notes" type="checkbox">
                                <label for="notes">&nbsp;&nbsp;Notes</label>
                            </span>
                        </div>
                        <div class="col-sm-2">
                            <span class="checkbox custom-checkbox custom-checkbox-teal">
                                <input id="activity" name="activity" type="checkbox">
                                <label for="activity">&nbsp;&nbsp;Activities</label>
                            </span>
                        </div>
                        <div class="col-sm-2">
                            <span class="checkbox custom-checkbox custom-checkbox-teal">
                                <input id="attachments" name="attachments" type="checkbox">
                                <label for="attachments">&nbsp;&nbsp;Attachments</label>
                            </span>
                        </div>
                        <div class="col-sm-2">
                            <span class="checkbox custom-checkbox custom-checkbox-teal">
                                <input id="campaign" name="campaign" type="checkbox">
                                <label for="campaign">&nbsp;&nbsp;Campaigns</label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Re Assign Leads</button>
                        <a href="{{ route('leads-assign-filter') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
</div>


           {{ csrf_field() }}
           </form>

@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

{{-- <script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>--}}
<script type="text/javascript">

var select_all = document.getElementById("chkAll"); //select all checkbox
var checkboxes = document.getElementsByClassName("lol"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});



for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.lol:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}

// ,,
$(document).ready(function() {
    oTable = $('#Leads').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('leads.datatables',json_encode($leads)) }}",
        "columns": [
            {data: 'id', name: 'clients.id'},
            {data: 'name', name: 'clients.name'},
            // {data: 'last-name', name: 'clients.last_name'},
            {data: 'phone', name: 'clients.Phone'},
            {data: 'assigned', name: 'assigned'},
            {data: 'source', name: 'source'},
            {data: 'status', name: 'status'},
            {data: 'create', name: 'create'}
        ],initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });

     $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });


});


</script>
@stop