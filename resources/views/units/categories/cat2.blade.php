<div class="col-sm-6">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="total_built_area_2">Total Built Area:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->total_built_area }} m<sub>2</sub></label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="total_land_area_2">Total Land Area:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->total_land_area }} m<sub>2</sub></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="garden_area_2">Garden Area:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->garden_area }} m<sub>2</sub></label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label text-left" for="finish_2">Finish:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->Finish->label }}</label>
            </div>
        </div>
    </div>

</div>
<div class="col-sm-6">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label text-left" for="bedrooms_2">Bedrooms:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->bedrooms }}</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label text-left" for="bathrooms_2">Bathrooms:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->bathrooms }}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('garage_2', 1, $unit->garage, ['id' => 'garage_2', 'disabled']) }}
                    <label for="garage_2">&nbsp;&nbsp;Garage</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('roof_terrace_2', 1, $unit->roof_terrace, ['id' => 'roof_terrace_2', 'disabled']) }}
                    <label for="roof_terrace_2">&nbsp;&nbsp;Roof Terrace</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('elevator_2', 1, $unit->elevator, ['id' => 'elevator_2', 'disabled']) }}
                    <label for="elevator_2">&nbsp;&nbsp;Elevator</label>
                </div>
            </div>
        </div>
    </div>
</div>