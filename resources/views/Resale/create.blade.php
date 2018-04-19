@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
    <form action="{{ route('resales.store') }}" method="post" id="FormID" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Create A New Resale</h3>
            </div>
            <div class="panel-body">

                 <div class="page-header no-border mb0">
                    <h3>Add another Resale</h3>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Sale Type <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="sale_type" class="form-control input-sm">
                                        @foreach(array( 'sale' => 'For Sale', 'rent' => 'For Rent') as $k=>$v)
                                          <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
 
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Finishing <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                   <select name="status" class="form-control input-sm">                                    
                                    @foreach(\App\Models\Finish::Where('published', 1)->orderBy('sort_order', 'ASC')->get() as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->label }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">floor <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="floor" class="form-control input-sm" placeholder="floor number">
                                </div>
                            </div>
                        </div>
                    </div>
 


 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Location<span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="location_id" class="form-control input-sm ">
                                        @foreach($districts as $k=>$V)
                                            <option value="{{ $k}}">{{ $districts[$k] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Project Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="project_id" class="form-control input-sm ">
                                        @foreach(\App\Models\ParameterProject::all() as $V)
                                            <option value="{{ $V->id }}">{{ $V->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
 




                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Unit Number <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="unit_number" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">phase <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="phase" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Built Up Area <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="built_up_area" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Land Area<span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="land_area" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Unit Price <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="unit_price" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Down Payment <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="down_payment" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Transfer Fees <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="transfer_fees" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Buyer Commission <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="buyer_commission" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 
 

 
 
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">property_type <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="property_type" class="form-control input-sm">
                                        @foreach($types as $k=>$V)
                                            <option value="{{ $k }}">{{ $types[$k] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->role_id == '1')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="unit_placed_in">Unit Where Placed <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="unit_placed_in[]" class="form-control input-sm" id="UnitWherePlaced" multiple>
                                        @foreach(\App\Models\UnitPlace::where('published',true)->get() as $obj)
                                            <option value="{{ $obj->name }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Seller Commission <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" name="seller_commission" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Installment <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select name="installment" class="form-control input-sm">
                                            <option value="cash">cash</option>
                                            <option value="one">one year</option>
                                            <option value="two">two years</option>
                                            <option value="three">three years</option>
                                            <option value="four">four years</option>
                                            <option value="five">five years</option>
                                            <option value="six">six years</option>
                                            <option value="seven">seven years</option>
                                            <option value="eight">eight years</option>
                                            <option value="nine">nine years</option>
                                            <option value="ten">ten years</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
 

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Delivery Date <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="delivery_date" class="form-control input-sm full-date-picker">
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Notes <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea name="notes" class="form-control input-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                <hr class="dotted">
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">Client Name <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="client_name" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>

 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="new_first_name">mobile <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="mobile" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
 

 
 

                </div>
                <hr class="dotted">
 

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
 --}}                        <a href="{{ url('resales') }}" class="btn btn-danger">Cancel</a>
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
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/jqueryui/js/jquery-ui-timepicker.min.js') }}"></script>

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
  

    $("#e2,#e1,#UnitWherePlaced").select2({
         placeholder: "Select a State",
         allowClear: true
    });


   if($(".full-date-picker").length){
        $(".full-date-picker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    }


</script>

@stop
