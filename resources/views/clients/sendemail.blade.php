@extends('common.master')

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-send-email-post', $client->id) }}" method="post" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Choose An Email Template</h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email_title">Email Subject:</label>
                        <div class="col-sm-9">
                            <input type="text" name="email_title" id="email_title" class="form-control input-sm">
                            <div class="help-block text-muted">
                                Note: If the Email Subject left blank, the system will Automatically use the selected Email Template's Title
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive panel-collapse pull out clearfix" style="">
                    <table class="table table-bordered table-hover responsive" id="Leads_Table">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="35%">Template Name</th>
                                <th>Project</th>
                                <th>Expiry Date</th>
                                <th width="10%">Sent #</th>
                                <th width=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($email_templates as $email)
                            <tr>
                                <td>
                                    <span class="radio custom-radio custom-radio-teal">  
                                        <input type="radio" name="selected_template" data-parsley-required data-parsley-error-message="You have to choose an Email Template to Send." data-parsley-multiple="mymultiplelink" data-parsley-errors-container="#errors" id="{{ 'selected_template'.$email->id }}" value="{{ $email->id }}">
                                        <label for="{{ 'selected_template'.$email->id }}"></label>
                                    </span>
                                </td>
                                <td>{{ $email->template_name }}</td>
                                <td>{{ $email->Project->name }}</td>
                                <td>{{ ($email->expiry_date) ? $email->expiry_date : "<center>---</center>" }}</td>
                                <td>{{ $email->sent_number }}</td>
                                <td>
                                    <div class="toolbar">
                                        <a href="{{ route('emails-view-single', array($email->id)) }}" class="btn btn-default btn-xs">View</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th><input type="search" class="form-control" name="search_engine" placeholder="Template Name"></th>
                                <th><input type="search" class="form-control" name="search_engine" placeholder="Project"></th>
                                <th><input type="search" class="form-control" name="search_engine" placeholder="Expiry Date"></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="errors">
                        @if($errors->has('selected_template'))
                            <div class="help-block">{{ $errors->first('selected_template') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Send</button>
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
</div>

@stop

            
@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/css/jquery.datatables.min.css') }}">

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/tabletools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/tabletools/js/zeroclipboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/datatables/js/jquery.datatables-custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/tables/datatable.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>

@stop