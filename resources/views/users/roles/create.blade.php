@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-user-plus mr10"></i>Create A New Role</h3>

        </div>
        <!--/ panel heading/header -->
        <form action="{{ route('roles-create-post') }}" method="post" class="form-horizontal" data-parsley-validate>
        <!-- panel body with collapse capabale -->
            <div class="panel-body" id="roles">
                <div class="row">
                    <div class="col-sm-6">
                        @if($errors->has('role_name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="role_name">Role Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ Form::text('role_name', null, ['id' => 'role_name', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) }}
                                @if($errors->has('role_name'))
                                <div class="help-block mt10">{{ $errors->first('role_name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="thin-title"><a data-toggle="collapse" data-parent="#info" href="#role-leads" class="collapsed"> Leads</a></h3>
                        <div class="" id="role-leads">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_leads', null, 0, ['id' => 'view_leads']) }}
                                        <label for="view_leads">&nbsp;&nbsp;View Assigned Leads</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_all_leads', null, 0, ['id' => 'view_all_leads']) }}
                                        <label for="view_all_leads">&nbsp;&nbsp;View All Leads</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('modify_all_leads', null, 0, ['id' => 'modify_all_leads']) }}
                                        <label for="modify_all_leads">&nbsp;&nbsp;Modify All Leads</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('delete_lead_info', null, 0, ['id' => 'delete_lead_info']) }}
                                        <label for="delete_lead_info">&nbsp;&nbsp;Delete Any Lead Info</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_any_lead_note', null, 0, ['id' => 'view_any_lead_note']) }}
                                        <label for="view_any_lead_note">&nbsp;&nbsp;View Any Lead Notes</label>
                                    </span>
                                </div>
                            
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_any_lead_activities', null, 0, ['id' => 'view_any_lead_activities']) }}
                                        <label for="view_any_lead_activities">&nbsp;&nbsp;View Any Lead Activities</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_any_lead_emails', null, 0, ['id' => 'view_any_lead_emails']) }}
                                        <label for="view_any_lead_emails">&nbsp;&nbsp;View Any Lead Emails</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_any_lead_attachments', null, 0, ['id' => 'view_any_lead_attachments']) }}
                                        <label for="view_any_lead_attachments">&nbsp;&nbsp;View Any Lead Attachments</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_any_lead_campaigns', null, 0, ['id' => 'view_any_lead_campaigns']) }}
                                        <label for="view_any_lead_campaigns">&nbsp;&nbsp;View Any Lead Campaigns</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('convert_any_customer', null, 0, ['id' => 'convert_any_customer']) }}
                                        <label for="convert_any_customer">&nbsp;&nbsp;Convert Any Lead</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mt10">
                        <h3 class="thin-title"><a data-toggle="collapse" data-parent="#info" href="#role-customers" class="collapsed"> Customers</a></h3>
                        <div class="" id="role-customers">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_customers', null, 0, ['id' => 'view_customers']) }}
                                        <label for="view_customers">&nbsp;&nbsp;View Assigned Customers</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('view_all_customers', null, 0, ['id' => 'view_all_customers']) }}
                                        <label for="view_all_customers">&nbsp;&nbsp;View All Customers</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('modify_all_customers', null, 0, ['id' => 'modify_all_customers']) }}
                                        <label for="modify_all_customers">&nbsp;&nbsp;Modify All Customers</label>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span class="checkbox custom-checkbox custom-checkbox-teal">
                                        {{ Form::checkbox('delete_customer_info', null, 0, ['id' => 'delete_customer_info']) }}
                                        <label for="delete_customer_info">&nbsp;&nbsp;Delete Any Customer Info</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ panel body with collapse capabale -->
            {{ csrf_field() }}
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <button name="submit" value="save-new" type="submit" class="btn btn-primary">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10">Save & Close</button>
                        <a href="{{ route('users-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </form>
</div>

@stop

@section('scripts')
        
{{ asset('plugins/parsley/js/parsley.min.js') }}
        
@stop