@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('leads-modify-single-post',$client->id) }}" method="post" id="FormID" class="form-horizontal" data-parsley-validate>
        {{ method_field('PUT') }}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Create A New Lead</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="title" class="form-control input-sm minor">
                                        @foreach($title as $k=>$v)
                                          <option value="{{ $k }}" {{ $client->title == $k ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control input-sm" name="name" id="name" value="{{ $client->name }}" data-parsley-required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="company">Company:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="company" id="company" value="{{ $client->company }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="work_title">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="work_title" id="work_title" value="{{ $client->work_title }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="phone">Phone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="phone" id="phone" value="{{ $client->Phone }}">
                                
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="mobile">Mobile (1):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="mobile" id="mobile" value="{{ $client->mobile }}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="mobile_two">Mobile (2):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="mobile_two" id="mobile_two" value="{{ $client->mobile_two }}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="international_number">International Number:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="international_number" id="international_number" value="{{ $client->international_number }}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="email" id="email" data-parsley-type="email" value="{{ $client->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="secondary_email">Secondary Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="secondary_email" id="secondary_email" data-parsley-type="email" value="{{ $client->secondary_email }}">
                            </div>
                        </div>


                        <div class="row">

                           <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="project_id">Projects:</label>
                                    <div class="col-sm-9">
                                        <select name="project_id[]" id="e1" class="form-control input-sm minor" multiple>
                                            @foreach(\App\Models\ParameterProject::where('published',true)->get() as $V)
                                                <option value="{{ $V->id }}" {{ in_array( $V->id, $client->projects->pluck('id')->toArray())  ? 'selected' : '' }}>{{ $V->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            @if(auth()->user()->role_id == '1')
                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label" for="assign_to">Assign To:</label>
                                    <div class="col-sm-9">
                                        <select name="assign_to" class="form-control input-sm minor">
                                            @foreach($users as $k=>$v)
                                               <option value="{{ $k }}" {{ $client->assigned_to == $k ? 'selected' : '' }}>{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="assign_leads" value="1">
                                    </div>
                                </div>
                             </div>
                             @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="last_name">Last Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="last_name" id="last_name" value="{{ $client->last_name }}"{>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="fax">Fax:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="fax" id="fax" value="{{ $client->fax }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_status">Lead Status:</label>
                            <div class="col-sm-9">
                                <select name="lead_status" class="form-control input-sm">
                                    @foreach($lead_status as $k=>$v)
                                          <option value="{{ $k }}" {{ $client->client_status_id == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_source">Lead Source:</label>
                            <div class="col-sm-9">
                                <select name="lead_source" class="form-control input-sm">
                                    @foreach($lead_source as $k=>$v)
                                        <option value="{{ $k }}" {{ $client->client_source_id == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>                                                                
                            </div>
                        </div>


                        <!-- MY EDIT START -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lead_status">Rent/Buyer/seller:</label>
                            <div class="col-sm-9">
                                <select name="cat" class="form-control">
                                    @foreach(array('1' => '-None-', 'Rent' => 'Wanna Rent', 'Buyer' => 'Buyer', 'Seller' => 'Seller', 'Renter' => 'Has Property To Rent') as $k=>$v)
                                      <option value="{{ $k }}" {{ $client->cat == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- MY EDIT END -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_district">District Interested In:</label>
                                    <div class="col-sm-9">
                                        <select name="interested_district" class="form-control input-sm minor">
                                            @foreach($districts as $k=>$V)
                                                <option value="{{ $k}}" {{ $client->interested_district == $k ? 'selected' : '' }}>{{ $districts[$k] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_type">Property Type Interested In:</label>
                                    <div class="col-sm-9">
                                        <select name="interested_type" class="form-control input-sm minor">
                                            @foreach($types as $k=>$V)
                                                <option value="{{ $k }}" {{ $client->interested_type == $k ? 'selected' : '' }}>{{ $types[$k] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="developer_id">Developers:</label>
                                    <div class="col-sm-9">
                                        <select name="developer_id[]" id="e2" class="form-control input-sm minor" multiple>
                                                <option value="">--None--</option>
                                            @foreach(\App\Models\Developer::where('published',true)->get() as $v)
                                                <option value="{{ $v->id }}" {{ in_array( $v->id, DB::table('clients_developers')->where('client_id',$client->id)->pluck('developer_id')->toArray())  ? 'selected' : '' }}>{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-right" for="interested_type">Badget:</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="from" placeholder="From" class="form-control" style="width: 49%!important;display: inline!important;" value="{{ $client->badget_from }}">
                                        <input type="number" name="to" placeholder="To" class="form-control" style="width: 49%!important;display: inline!important;" value="{{ $client->badget_to }}">
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="new_title" class="form-control input-sm minor">
                                        @foreach($title as $k=>$v)
                                          <option value="{{ $k }}" {{ $client->sub()->first() && $client->sub()->first()->title == $v ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <!-- /btn-group -->
                                    <input type="text" class="form-control input-sm" name="new_first_name" id="name" value="{{ $client->sub()->first() ? $client->sub()->first()->first_name : '' }} " >
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_last_name">Last Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_last_name" id="new_last_name" value="{{ $client->sub()->first() ? $client->sub()->first()->last_name : '' }} " >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_phone">Phone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_phone" id="new_phone" value="{{ $client->sub()->first() ? $client->sub()->first()->phone : '' }} " >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_mobile_one">Mobile (1):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_mobile_one" id="new_mobile_one" value="{{ $client->sub()->first() ? $client->sub()->first()->mobile_one : '' }} " >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_mobie_two">Mobile (2):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_mobie_two" id="new_mobie_two" value="{{ $client->sub()->first() ? $client->sub()->first()->mobile_two : '' }} " >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_international_number">International Number:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_international_number" id="new_international_number" value="{{ $client->sub()->first() ? $client->sub()->first()->international_number : '' }} " >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="new_email" id="new_email" value="{{ $client->sub()->first() ? $client->sub()->first()->email : '' }} " >
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="description">Description <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" cols="5" name="description" id="description" data-parsley-maxlength="5120" data-parsley-required>{{ $client->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">







                <div class="page-header no-border mb0">
                    <h3>Address Information</h3>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="street">Street:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="street" id="street" value="{{ $client->street }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="state">State:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="state" id="state" value="{{ $client->state }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="country">Country:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="country" id="country" value="{{ $client->country }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="city">City:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="city" id="city" value="{{ $client->city }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="zip_code">Zip Code:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="zip_code" id="zip_code" value="{{ $client->zip_code }}">
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
                $('#messagesID').html('<div class="alert alert-success">Updated Successfully</div>'); //appending to a <div id="form-errors"></div> inside form
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
