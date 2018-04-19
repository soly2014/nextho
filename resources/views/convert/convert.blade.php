@extends('common.master')

@section('breadcrumbs')
   @include('common.breadcrumbs')
@stop


@section('content')

<div class="col-sm-12">
    <form action="{{ route('post.convertto.client',$id) }}" method="post" id="FormID" class="form-horizontal" data-parsley-validate>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-user-plus3 mr10"></i>Convert Lead</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Share <span class="text-danger">*</span>:</label>
                            <div class="col-sm-4">
                                <div class="input-group" >
                                    <select name="shared_with" class="form-control input-sm" style="width: 100%!important;">
                                           <option value="">-----</option>                                        
                                        @foreach(\App\Models\User::where('active', true)->pluck('username', 'id')->toArray() as $k=>$v)
                                           <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group" >
                                    <input type="number" name="share" class="form-control input-sm" style="width: 100%!important;" placeholder="Equity %">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Date <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group" >
                                    <input type="text" name="date" class="form-control input-sm date-picker" style="width: 100%!important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Unit Type <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group" >
                                    <select name="unit_type" class="form-control input-sm" style="width: 100%!important;">
                                        @foreach($types as $k=>$V)
                                            <option value="{{ $k }}">{{ $types[$k] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Area <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group" >
                                    <input type="number" name="area" class="form-control input-sm" style="width: 100%!important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Sold Price <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group" >
                                    <input type="number" name="sold_price" class="form-control input-sm" style="width: 100%!important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Options <span class="text-danger">*</span>:</label>
                            <div class="col-sm-9">
                                <div class="input-group" >
                                    <select name="option" class="form-control input-sm" style="width: 100%!important;" id="Option">
                                        <option value="project">Projects</option>
                                        <option value="resale" selected>Resale</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>




                    {{-- Select Project --}}
                    <div id="Project" class="hidden">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Developer <span class="text-danger">*</span>:</label>
                                <div class="col-sm-9">
                                    <div class="input-group" >
                                        <select name="developer" class="form-control input-sm" style="width: 100%!important;" id="Developer">
                                              <option value=""> --Select-- </option>
                                            @foreach(\App\Models\Developer::all() as $dev)
                                              <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Project <span class="text-danger">*</span>:</label>
                                <div class="col-sm-9">
                                    <div class="input-group" >
                                        <select name="project" class="form-control input-sm" style="width: 100%!important;" id="ProjectList">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Select Project --}}





                    {{-- Select Resale --}}
                    <div id="Resale">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Buyer <span class="text-danger">*</span>:</label>
                                <div class="col-sm-9">
                                    <div class="input-group" >
                                        <select name="client_type" class="form-control input-sm" style="width: 100%!important;" id="Developer">
                                            @foreach(array('' => '-None-', 'Rent' => 'Wanna Rent', 'Buyer' => 'Buyer', 'Seller' => 'Seller', 'Renter' => 'Has Property To Rent') as $k=>$v)
                                              <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Location <span class="text-danger">*</span>:</label>
                                <div class="col-sm-9">
                                    <div class="input-group" >
                                        <textarea name="location" class="form-control input-sm" style="width: 100%!important;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Select Resale --}}




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
                                <input type="text" class="form-control input-sm" name="street" id="street">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="state">State:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="state" id="state">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="country">Country:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="country" id="country">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="city">City:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="city" id="city">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="zip_code">Zip Code:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="zip_code" id="zip_code">
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
                        <button name="submit" value="save" type="submit" class="btn btn-primary submit-class">Convert</button>
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

<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/jqueryui/css/jquery-ui-timepicker.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
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
  

    // display month & year
    if($(".date-picker").length){
        $(".date-picker").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: 0
        });
    }
        
    if($(".full-date-picker").length){
        $(".full-date-picker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    }

    
    $('#Option').on('change',function(){
        var option = $('#Option').val();
        if (option == 'project') {
            $('#Resale').addClass('hidden');
            $('#Project').removeClass('hidden');
        } else {
            $('#Project').addClass('hidden');            
            $('#Resale').removeClass('hidden');            
        }
    });

  
    
    $('#Developer').on('change',function(){
        var option = $('#Developer').val();
        $.ajax({
            type:'POST',
            data:{option:option},
            url:'{{ route('developer.projects') }}',
            success:function (data) {
                $('#ProjectList').html(data);
            }
        });
    });

  
    


</script>

@stop
