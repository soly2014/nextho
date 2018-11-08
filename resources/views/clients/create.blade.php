@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-create-post') }}" method="post" id="FormID" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Create A New Lead</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        @if($errors->has('name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="name">Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="title" class="form-control input-sm minor">
                                        @foreach($title as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <!-- /btn-group -->
                                    <input type="text" class="form-control input-sm" name="name" id="name"{{ (old('name') ? '  value="'.e(old('name')).'"' : '') }} data-parsley-required>
                                    @if($errors->has('name'))
                                    <div class="help-block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                        @if($errors->has('company'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="company">Company:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="company" id="company"{{ (old('company') ? '  value="'.e(old('company')).'"' : '') }}>
                                @if($errors->has('company'))
                                <div class="help-block">{{ $errors->first('company') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('work_title'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="work_title">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="work_title" id="work_title"{{ (old('work_title') ? '  value="'.e(old('work_title')).'"' : '') }}>
                                @if($errors->has('work_title'))
                                <div class="help-block">{{ $errors->first('work_title') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('phone'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="phone">Phone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="phone" id="phone"{{ (old('phone') ? '  value="'.e(old('phone')).'"' : '') }} data-parsley-type="number">
                                @if($errors->has('phone'))
                                <div class="help-block">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>


                        @if($errors->has('mobile'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="mobile">Mobile (1):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="mobile" id="mobile" value="{{ session('number_type_mobile') ? : '' }}" {{ session('number_type_mobile') ? 'readonly' : '' }} data-parsley-type="number" data-parsley-minlength="11" data-parsley-maxlength="11">
                                @if($errors->has('mobile'))
                                <div class="help-block">{{ $errors->first('mobile') }}</div>
                                @endif
                            </div>
                        </div>




                        @if($errors->has('mobile_two'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="mobile_two">Mobile (2):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="mobile_two" id="mobile_two" data-parsley-type="number" data-parsley-minlength="11" data-parsley-maxlength="11">
                                @if($errors->has('mobile_two'))
                                <div class="help-block">{{ $errors->first('mobile_two') }}</div>
                                @endif
                            </div>
                        </div>




                        @if($errors->has('international_number'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="international_number">International Number:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="international_number" id="international_number"  value="{{ session('number_type_international_number') ?: '' }}"  {{ session('number_type_international_number') ? 'readonly': '' }} data-parsley-type="number" >
                                @if($errors->has('international_number'))
                                <div class="help-block">{{ $errors->first('international_number') }}</div>
                                @endif
                            </div>
                        </div>


                        @if($errors->has('email'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="email" id="email" data-parsley-type="email"{{ (old('email') ? '  value="'.e(old('email')).'"' : '') }}>
                                @if($errors->has('email'))
                                <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        @if($errors->has('secondary_email'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="secondary_email">Secondary Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="secondary_email" id="secondary_email" data-parsley-type="email"{{ (old('secondary_email') ? '  value="'.e(old('secondary_email')).'"' : '') }}>
                                @if($errors->has('secondary_email'))
                                <div class="help-block">{{ $errors->first('secondary_email') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="row">

                           <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="project_id">Projects: <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="project_id[]" id="e1" class="form-control input-sm minor" multiple>
                                            @foreach(\App\Models\ParameterProject::where('published',true)->get() as $V)
                                                <option value="{{ $V->id }}">{{ $V->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('project_id'))
                                    <div class="help-block" style="color: red;">{{ $errors->first('project_id') }}</div>
                                    @endif
                                    </div>
                                </div>
                            </div>

                            @if($initially_assign)
                             <div class="col-sm-12">
                                 @if($errors->has('assign_to'))
                                 <div class="form-group has-error">
                                 @else
                                 <div class="form-group">
                                 @endif
                                    <label class="col-sm-3 control-label" for="assign_to">Assign To: <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="assign_to" class="form-control input-sm minor">
                                            @foreach($users as $k=>$v)
                                               <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="assign_leads" value="1">
                                        @if($errors->has('assign_to'))
                                        <div class="help-block">{{ $errors->first('assign_to') }}</div>
                                        @endif
                                    </div>
                                </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                        @if($errors->has('last_name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="last_name">Last Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="last_name" id="last_name"{{ (old('last_name') ? '  value="'.e(old('last_name')).'"' : '') }}>
                                @if($errors->has('last_name'))
                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_status">Lead Status: <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="lead_status" class="form-control input-sm">
                                    @foreach($lead_status as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>                                
                                @if($errors->has('lead_status'))
                                <div class="help-block" style="color: red;">{{ $errors->first('lead_status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_source">Lead Source: <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="lead_source" class="form-control input-sm">
                                    @foreach($lead_source as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>                                                                
                                @if($errors->has('lead_source'))
                                <div class="help-block" style="color: red;">{{ $errors->first('lead_source') }}</div>
                                @endif
                            </div>
                        </div>


                        <!-- MY EDIT START -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_status">Rent/Buyer/seller: <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="cat" class="form-control">
                                    @foreach(array('1' => '-None-', 'Rent' => 'Wanna Rent', 'Buyer' => 'Buyer', 'Seller' => 'Seller', 'Renter' => 'Has Property To Rent') as $k=>$v)
                                      <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('cat'))
                                <div class="help-block" style="color: red;">{{ $errors->first('cat') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- MY EDIT END -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_district">District Interested In: <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="interested_district" class="form-control input-sm minor">
                                            @foreach($districts as $k=>$V)
                                                <option value="{{ $k}}">{{ $districts[$k] }}</option>
                                            @endforeach
                                        </select>
                                    	@if($errors->has('interested_district'))
	                                <div class="help-block" style="color: red;">{{ $errors->first('interested_district') }}</div>
	                                @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_type">Property Type Interested In: <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="interested_type" class="form-control input-sm minor">
                                            @foreach($types as $k=>$V)
                                                <option value="{{ $k }}">{{ $types[$k] }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('interested_type'))
                                    <div class="help-block" style="color: red;">{{ $errors->first('interested_type') }}</div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="developer_id">Developers: <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="developer_id[]" id="e2" class="form-control input-sm minor" multiple>
                                                <option value="">--None--</option>
                                            @foreach(\App\Models\Developer::where('published',true)->get() as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('developer_id'))
                                    <div class="help-block" style="color: red;">{{ $errors->first('developer_id') }}</div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_type">Badget:</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="from" placeholder="From" class="form-control" style="width: 49%!important;display: inline!important;">
                                        <input type="number" name="to" placeholder="To" class="form-control" style="width: 49%!important;display: inline!important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">









                 <div class="page-header no-border mb0">
                    <h3>Add another Contact</h3>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        @if($errors->has('new_first_name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_first_name">Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="new_title" class="form-control input-sm minor">
                                        @foreach($title as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <!-- /btn-group -->
                                    <input type="text" class="form-control input-sm" name="new_first_name" id="name"{{ (old('new_first_name') ? '  value="'.e(old('new_first_name')).'"' : '') }}>
                                    @if($errors->has('new_first_name'))
                                    <div class="help-block">{{ $errors->first('new_first_name') }}</div>
                                    @endif
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                        @if($errors->has('new_last_name'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_last_name">Last Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_last_name" id="new_last_name"{{ (old('new_last_name') ? '  value="'.e(old('new_last_name')).'"' : '') }}>
                                @if($errors->has('new_last_name'))
                                <div class="help-block">{{ $errors->first('new_last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('new_phone'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_phone">Phone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_phone" id="new_phone"{{ (old('new_phone') ? '  value="'.e(old('new_phone')).'"' : '') }} data-parsley-type="number" >
                                @if($errors->has('new_phone'))
                                <div class="help-block">{{ $errors->first('new_phone') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('new_mobile_one'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_mobile_one">Mobile (1):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_mobile_one" id="new_mobile_one"{{ (old('new_mobile_one') ? '  value="'.e(old('new_mobile_one')).'"' : '') }} data-parsley-type="number" data-parsley-minlength="11" data-parsley-maxlength="11">
                                @if($errors->has('new_mobile_one'))
                                <div class="help-block">{{ $errors->first('new_mobile_one') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('new_mobie_two'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_mobie_two">Mobile (2):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_mobie_two" id="new_mobie_two"{{ (old('new_mobie_two') ? '  value="'.e(old('new_mobie_two')).'"' : '') }} data-parsley-type="number" data-parsley-minlength="11" data-parsley-maxlength="11">
                                @if($errors->has('new_mobie_two'))
                                <div class="help-block">{{ $errors->first('new_mobie_two') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($errors->has('new_international_number'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_international_number">International Number:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_international_number" id="new_international_number"{{ (old('new_international_number') ? '  value="'.e(old('new_international_number')).'"' : '') }}>
                                @if($errors->has('new_international_number'))
                                <div class="help-block">{{ $errors->first('new_international_number') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($errors->has('new_email'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="new_email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_email" id="new_email"{{ (old('new_email') ? '  value="'.e(old('new_email')).'"' : '') }}>
                                @if($errors->has('new_email'))
                                <div class="help-block">{{ $errors->first('new_email') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">
 


                 <div class="page-header no-border mb0">
                    <h3>Description Information</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->has('description'))
                        <div class="form-group has-error">
                        @else
                        <div class="form-group">
                        @endif
                            <label class="col-sm-3 control-label" for="description">Description <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" cols="5" name="description" id="description" data-parsley-maxlength="5120" data-parsley-required>{{ e(old('description')) }}</textarea>
                                @if($errors->has('description'))
                                <div class="help-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- messages ID --}}
                <div class="row">
                    <div class="col-md-12" id="messagesID">
                    </div>
                </div>
                {{-- End Messages --}}

            </div>
            <div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary submit-class">Save</button>
{{--                         <button name="submit" value="save-new" type="submit" class="btn btn-primary submit-class">Save & New</button>
                        <button name="submit" value="save-close" type="submit" class="btn btn-primary mr10 submit-class">Save & Close</button>
 --}}                        <a href="{{ route('leads-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

        {{ csrf_field() }}
    </form>
</div>

@stop

@section('scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">

   
    /* edit Production Company form */
    $('#FormID').ajaxForm({

        beforeSubmit: function() {

            $('.submit-class').html('loading').prop('disabled', false);

        },
        success: function(response) {
             if (response.success == false) {
                $('#messagesID').html(response.message);
             } else {
                $('#messagesID').html('<div class="alert alert-success">Added Successfully</div>'); //appending to a <div id="form-errors"></div> inside form
             }
            $('.submit-class').html('<i class="fa fa-plus"></i> Save').prop('disabled', false);

          // window.location.href = siteBaseURL + "admin/violation";
        },
        error: function(error) {
            console.log(error);
            //process validation errors here.
            var errors = error.responseJSON.errors; //this will get the errors response data.
            //show them somewhere in the markup
            //e.g
            errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each(errors, function(key, value) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></div>';
            $('#messagesID').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
            // swal(errorsHtml); //appending to a <div id="form-errors"></div> inside form

            $('.submit-class').html('<i class="fa fa-plus"></i> Save').prop('disabled', false);
        },

    });
    /* end edit Production Company form */
  

    $("#e2,#e1").select2({
         placeholder: "Select a State",
         allowClear: true
    });


</script>

@stop
