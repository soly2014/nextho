<form action="{{ route('units-search-post') }}" method="post" class="form-horizontal">
     <div class="panel-body">   
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left" for="district">District</label>
                <div class="col-sm-12">
                    {{ Form::select('district', $project_districts, null, array('id' => 'district', 'class' => 'form-control input-sm')); }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left" for="unit_type">Unit Type</label>
                <div class="col-sm-12">
                    {{ Form::select('unit_type', $unit_types, null, array('id' => 'unit_type', 'class' => 'form-control input-sm')); }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left" for="finish">Finish</label>
                <div class="col-sm-12">
                    {{ Form::select('finish', $unit_finishs, null, array('id' => 'finish', 'class' => 'form-control input-sm')); }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left" for="delivery_date">Delivery Date(Year):</label>
                <div class="col-sm-12">
                    {{ Form::text('delivery_date', null, ['id' => 'delivery_date', 'class' => 'form-control input-sm']) }}
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left">Area:</label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm full-width">
                        {{ Form::text('min_area', null, ['id' => 'min_area', 'class' => 'form-control input-sm']) }}
                        <span class="input-group-addon input-sm">m<sub>2</sub></span>
                    </div>
                    <span class="text-muted">Min. Area</span>
                </div>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm full-width">
                        {{ Form::text('max_area', null, ['id' => 'max_area', 'class' => 'form-control input-sm']) }}
                        <span class="input-group-addon input-sm">m<sub>2</sub></span>
                    </div>
                    <span class="text-muted">Max. Area</span>
                </div>
                @if($errors->has('min_area') || $errors->has('max_area'))
                <div class="help-block text-danger">{{ $errors->first('min_area') }}</div>
                <div class="help-block text-danger">{{ $errors->first('max_area') }}</div>
                @endif
                    <!--<div class="slider-primary mb15" data-min="0" data-max="100" data-value-min="10" data-value-max="10"></div>-->
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-sm-12 control-label text-left">Price:</label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm full-width">
                        {{ Form::text('min_price', null, ['id' => 'min_price', 'class' => 'form-control input-sm']) }}
                        <span class="input-group-addon input-sm">EGP</span>
                    </div>
                    <span class="text-muted">Min. Price</span>
                </div>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm full-width">
                        {{ Form::text('max_price', null, ['id' => 'max_price', 'class' => 'form-control input-sm']) }}
                        <span class="input-group-addon input-sm">EGP</span>
                    </div>
                    <span class="text-muted">Max. Price</span>
                </div>
                @if($errors->has('min_price') || $errors->has('max_price'))
                <div class="help-block text-danger">{{ $errors->first('min_price') }}</div>
                <div class="help-block text-danger">{{ $errors->first('max_price') }}</div>
                @endif
                    <!--<div class="slider-primary mb15" data-min="0" data-max="100" data-value-min="10" data-value-max="10"></div>-->
            </div>
        </div>
    </div>
    {{ csrf_field() }}
    <div class="panel-footer">
        <div class="form-group no-border">
            <label class="col-sm-3 control-label">Submit</label>
            <div class="col-sm-9">
                <button name="submit" value="search" type="submit" class="btn btn-primary btn-sm">Search</button>
                <button type="reset" href="{{ route('units-view') }}" class="btn btn-danger btn-sm">Reset</button>
            </div>
        </div>
    </div>
</form>