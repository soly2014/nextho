@extends('common.master') 

@section('breadcrumbs') 

@include('common.breadcrumbs')

@stop 

@section('content')

<div class="col-md-12">
	<div class="panel panel-default">
		<!-- panel heading/header -->
		<div class="panel-heading">
			<h3 class="panel-title"><i class="ico-file mr10"></i>Customize the Report Params</h3>

		</div>
		<!--/ panel heading/header -->
		<form action="{{ route('report-clients-attr-post') }}" method="post" class="form-horizontal" data-parsley-validate>
			<!-- panel body with collapse capabale -->
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
							<div class="row">
								<div class="col-md-6">

									<div class="form-group">

										<label class="col-sm-3 control-label" for="name">Name:</label>
										<div class="col-sm-9">
											<div class="input-group">
												{{ Form::select('title', $title, old('title'), array('class' => 'form-control input-sm minor')); }}
												<!-- /btn-group -->
												<input type="text" class="form-control input-sm" name="name" id="name" {{ (old('name') ? '  value="'.e(old('name')). '"' : '') }} >

											</div>
											<!-- /input-group -->
										</div>
									</div>

									<div class="form-group">

										<label class="col-sm-3 control-label" for="company">Company:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="company" id="company" {{ (old('company') ? '  value="'.e(old('company')). '"' : '') }}>

										</div>
									</div>


									<div class="form-group">

										<label class="col-sm-3 control-label" for="work_title">Title:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="work_title" id="work_title" {{ (old('work_title') ? '  value="'.e(old('work_title')). '"' : '') }}>

										</div>
									</div>


									<div class="form-group">

										<label class="col-sm-3 control-label" for="phone">Phone:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="phone" id="phone" {{ (old('phone') ? '  value="'.e(old('phone')). '"' : '') }}>

										</div>
									</div>


									<div class="form-group">

										<label class="col-sm-3 control-label" for="mobile">Mobile:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="mobile" id="mobile" {{ (old('mobile') ? '  value="'.e(old('mobile')). '"' : 'value=""') }}>
										</div>
									</div>

									<div class="form-group">

										<label class="col-sm-3 control-label" for="email">Email:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="email" id="email" data-parsley-type="email" {{ (old('email') ? '  value="'.e(old('email')). '"' : '') }}>
											@if($errors->has('email'))
											<div class="help-block text-danger">{{ $errors->first('email') }}</div>
											@endif
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-4 offset-md-1 control-label">Leads</label>
												<div class="col-sm-7">
													<span class="checkbox custom-checkbox custom-checkbox-teal">
														<input type="checkbox" name="sel_leads" id="sel_leads" <?php if(old('sel_leads')== true) { echo 'checked="checked"'; } ?>/>
														<label for="sel_leads">&nbsp;&nbsp;Leads</label>
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-4 offset-md-1 control-label">Clients</label>
												<div class="col-sm-7">
													<span class="checkbox custom-checkbox custom-checkbox-teal">
														<input type="checkbox" name="clients" id="clients" <?php if(old('optout')== true) { echo 'checked="checked"'; } ?>/>
														<label for="clients">&nbsp;&nbsp;Clients</label>
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											@if($errors->has('leads') || $errors->has('clients'))
											<div class="help-block text-danger">
												{{ $errors->first('leads') }}
												<br />
												{{ $errors->first('clients') }}
											</div>
											@endif
										</div>
									</div>
								</div>

								<div class="col-md-6">

									<div class="form-group">

										<label class="col-sm-3 control-label" for="last_name">Last Name:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="last_name" id="last_name" {{ (old('last_name') ? '  value="'.e(old('last_name')). '"' : '') }}>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="lead_status">Lead Status:</label>
										<div class="col-sm-9">
											{{ Form::select('lead_status', $lead_status, old('lead_status'), array('class' => 'form-control input-sm')); }}
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="lead_source">Lead Source:</label>
										<div class="col-sm-9">
											{{ Form::select('lead_source', $lead_source, old('lead_source'), array('class' => 'form-control input-sm')); }}
										</div>
									</div>


									<div class="form-group">

										<label class="col-sm-3 control-label" for="secondary_email">Secondary Email:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="secondary_email" id="secondary_email" data-parsley-type="email" {{ (old('secondary_email') ? '  value="'.e(old('secondary_email')). '"' : '') }}>
											@if($errors->has('secondary_email'))
											<div class="help-block text-danger">{{ $errors->first('secondary_email') }}</div>
											@endif
										</div>
									</div>
									<div class="form-group">

										<label class="col-sm-3 control-label" for="fax">Assigned To:</label>
										<div class="col-sm-9">
											{{ Form::select('assigned_to', $all_users, old('assigned_to'), array('class' => 'form-control input-sm minor')); }}
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-12 control-label text-left" for="interested_district">District Interested In:</label>
												<div class="col-sm-12">
													{{ Form::select('interested_district', $districts, old('interested_district'), array('class' => 'form-control input-sm minor')); }}
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-12 control-label text-left" for="interested_type">Property Type Interested In:</label>
												<div class="col-sm-12">
													{{ Form::select('interested_type', $types, old('interested_type'), array('class' => 'form-control input-sm minor')); }}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="row">
							 <div class="col-sm-6">
								 <div class="form-group">
									 <label class="col-sm-4 control-label" for="start_date">Start Date:</label>
									<div class="col-sm-8">
										{{ Form::text('start_date', null, ['id' => 'start_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true']) }}
									</div>
								</div>
							 </div>
							 <div class="col-sm-6">
								 <div class="form-group">
									 <label class="col-sm-4 control-label" for="end_date">End Date:</label>
									<div class="col-sm-8">
										{{ Form::text('end_date', null, ['id' => 'end_date', 'class' => 'form-control input-sm full-date-picker', 'data-parsley-required' => 'true']) }}
									</div>
								</div>
							 </div>
						 </div>
							<div class="row">
								<div class="col-sm-2">
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<span class="checkbox custom-checkbox custom-checkbox-teal">
											<input type="checkbox" name="output[]" id="output_phone" value="Phone" <?php if(old('output_phone')== true) { echo 'checked="checked"'; } ?>/>
											<label for="output_phone">&nbsp;&nbsp;Phone</label>
										</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<span class="checkbox custom-checkbox custom-checkbox-teal">
											<input type="checkbox" name="output[]" id="output_mobile" value="mobile" <?php if(old('output_mobile')== true) { echo 'checked="checked"'; } ?>/>
											<label for="output_mobile">&nbsp;&nbsp;Mobile</label>
										</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<span class="checkbox custom-checkbox custom-checkbox-teal">
											<input type="checkbox" name="output[]" id="output_email" value="email" <?php if(old('output_email')== true) { echo 'checked="checked"'; } ?>/>
											<label for="output_email">&nbsp;&nbsp;Email</label>
										</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<span class="checkbox custom-checkbox custom-checkbox-teal">
											<input type="checkbox" name="output[]" id="output_secondary_email" value="secondary_email" <?php if(old('output_secondary_email')== true) { echo 'checked="checked"'; } ?>/>
											<label for="output_secondary_email">&nbsp;&nbsp;Secondary Email</label>
										</span>
									</div>
								</div>
							</div>
							{{ csrf_field() }}
					</div>
				</div>
			</div>
			<!--/ panel body with collapse capabale -->
			<div class="panel-footer">
				<div class="form-group no-border">
					<label class="col-sm-3 control-label">Submit</label>
					<div class="col-sm-9">
						<button name="submit" type="submit" class="btn btn-primary">Generate Report</button>
						<a href="{{ route('reports-view') }}" class="btn btn-danger">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

@stop 
@section('styles') 
	{{ asset('plugins/jqueryui/css/jquery-ui.min.css') }} 
	{{ asset('plugins/jqueryui/css/jquery-ui-timepicker.min.css') }} 
@stop 
@section('scripts') 
	{{ asset('plugins/parsley/js/parsley.min.js') }} 
	{{ asset('javascript/utils/forms.js') }} 
	{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }} 
	{{ asset('plugins/jqueryui/js/jquery-ui-timepicker.min.js') }} 
	{{ asset('javascript/forms/singleview.js') }} 
@stop