<div class="col-sm-6">
    <div class="form-group">
        <label class="col-sm-2 control-label" >Area:</label>
        <label class="col-sm-10 control-label control-label-value">{{ $unit->area }} m<sub>2</sub></label>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" >Floor:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->floor }}</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" >Finish:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->Finish->label }}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" >Bedrooms:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->bedrooms }}</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" >Bathrooms:</label>
                <label class="col-sm-8 control-label control-label-value">{{ $unit->bathrooms }}</label>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('garage_1', 1, $unit->garage, ['id' => 'garage_1', 'disabled']) }}
                    <label for="garage_1">&nbsp;&nbsp;Garage</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('garden_1', 1, $unit->garden, ['id' => 'garden_1', 'disabled']) }}
                    <label for="garden_1">&nbsp;&nbsp;Garden</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('roof_terrace_1', 1, $unit->roof_terrace, ['id' => 'roof_terrace_1', 'disabled']) }}
                    <label for="roof_terrace_1">&nbsp;&nbsp;Roof Terrace</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('roof_1', 1, $unit->roof, ['id' => 'roof_1', 'disabled']) }}
                    <label for="roof_1">&nbsp;&nbsp;Roof</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('elevator_1', 1, $unit->elevator, ['id' => 'elevator_1', 'disabled']) }}
                    <label for="elevator_1">&nbsp;&nbsp;Elevator</label>
                </div>
            </div>
        </div>
    </div>
</div>