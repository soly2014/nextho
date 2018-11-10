
@if($lead->street == "" || $lead->country == "" || $lead->city == "")

<div class="col-sm-12">
    <div class="alert alert-warning">
        <strong>Required! </strong> it appears that not all the required address information are filled out, you have to update the required information to be able to procced
    </div>
    <div class="row">
        <div class="col-md-6">
            @if($errors->has('street'))
            <div class="form-group has-error">
            @else
            <div class="form-group">
            @endif
                <label class="col-sm-3 control-label" for="street">Street<span class="text-danger">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="street" id="street"{{ (old('street') ? '  value="'.e(old('street')).'"' : 'value="'.$lead->street.'"') }} data-parsley-required>
                    @if($errors->has('street'))
                    <div class="help-block">{{ $errors->first('street') }}</div>
                    @endif
                </div>
            </div>
            @if($errors->has('state'))
            <div class="form-group has-error">
            @else
            <div class="form-group">
            @endif
                <label class="col-sm-3 control-label" for="state">State:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="state" id="state"{{ (old('state') ? '  value="'.e(old('state')).'"' : 'value="'.$lead->state.'"') }}>
                    @if($errors->has('state'))
                    <div class="help-block">{{ $errors->first('state') }}</div>
                    @endif
                </div>
            </div>
            @if($errors->has('country'))
            <div class="form-group has-error">
            @else
            <div class="form-group">
            @endif
                <label class="col-sm-3 control-label" for="country">Country<span class="text-danger">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="country" id="country"{{ (old('country') ? '  value="'.e(old('country')).'"' : 'value="'.$lead->country.'"') }} data-parsley-required>
                    @if($errors->has('country'))
                    <div class="help-block">{{ $errors->first('country') }}</div>
                    @endif
                </div>
            </div>
        </div>
            <div class="col-md-6">
                @if($errors->has('city'))
                <div class="form-group has-error">
                @else
                <div class="form-group">
                @endif
                <label class="col-sm-3 control-label" for="city">City<span class="text-danger">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="city" id="city"{{ (old('city') ? '  value="'.e(old('city')).'"' : 'value="'.$lead->city.'"') }} data-parsley-required>
                    @if($errors->has('city'))
                    <div class="help-block">{{ $errors->first('city') }}</div>
                    @endif
                </div>
            </div>
            @if($errors->has('zip_code'))
            <div class="form-group has-error">
            @else
            <div class="form-group">
            @endif
                <label class="col-sm-3 control-label" for="zip_code">Zip Code:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="zip_code" id="zip_code"{{ (old('zip_code') ? '  value="'.e(old('zip_code')).'"' : 'value="'.$lead->zip_code.'"') }}>
                    @if($errors->has('zip_code'))
                    <div class="help-block">{{ $errors->first('zip_code') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="address_info" value="1">
    <hr class="dotted">
</div>

@endif