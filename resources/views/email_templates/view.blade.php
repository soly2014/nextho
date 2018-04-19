@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')
<?php $send_any = Auth::user()->userRole->send_all_email_templates; ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-envelop mr10"></i>View All Email Templates</h3>
            <!-- panel toolbar -->
            <div class="panel-toolbar text-right">
                @if(Auth::user()->userRole->add_email_templates)
                <a href="{{ route('emails-create') }}" class="btn btn-sm btn-default"><i class="ico-envelop mr5"></i> Create New Email  Template</a>
                @endif
            </div>
        </div>
        <!--/ panel heading/header -->

        <!-- panel body with collapse capabale -->
        <div class="table-responsive panel-collapse pull out" style="">
            <table class="table table-bordered table-hover responsive" id="Leads_Table">
                <thead>
                    <tr>
                        <th width="35%">Template Name</th>
                        <th>Project</th>
                        <th>Created By</th>
                        <th>Expiry Date</th>
                        <th>Sent #</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($email_templates as $email)
                    <tr>
                        <td><a href="{{ route('emails-view-single', array($email->id)) }}">{{ $email->template_name }}</a>
                            @if($email->marked_deleted)
                                 - <span class="label label-danger" title="{{ 'Deleted By '.$email->userDeleted->username.' at '.$email->deleted_at }}">Deleted</span>
                            @endif
                            
                            @if(!$email->published)
                                 - <span class="label label-warning">Not Published</span>
                            @endif
                        </td>
                        <td><a href="{{ route('projects-view-single', array($email->Project->id)) }}">{{ $email->Project->name }}</a></td>
                        <td>{{ $email->userCreated->username }}</td>
                        <td>{{ ($email->expiry_date) ? $email->expiry_date : "<center>---</center>" }}</td>
                        <td>{{ $email->sent_number }}</td>
                        <td>
                            <div class="toolbar">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('emails-modify-single', array($email->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('emails-view-single', array($email->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                                    @if($email->published || $send_any)
                                        <li><a href="{{ route('send-selected-email-post', array($email->id)) }}"><i class="ico-mail-send mr5"></i> Send Email</a></li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Template Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Project"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Expiry Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sent #"></th>
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

{{ asset('javascript/forms/singleview.js') }}
{{ asset('javascript/utils/project.js') }}

@stop