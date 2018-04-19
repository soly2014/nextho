<div class="col-sm-6">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="total_built_area_3">Total Built Area:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->total_built_area }} m<sub>2</sub></label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="total_land_area_3">Total Land Area:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->total_land_area }} m<sub>2</sub></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="numner_of_floors_3">Number Of Floors:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->number_of_floors }}</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-7 control-label text-left" for="number_of_appartments_floor_3">Number Of Appartments/Floor:</label>
                <label class="col-sm-5 control-label control-label-value">{{ $unit->number_of_apartments_Floor }}</label>
            </div>
        </div>
    </div>

</div>
<div class="col-sm-6">
    <br>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('garage_3', 1, $unit->garage, ['id' => 'garage_3', 'disabled']) }}
                    <label for="garage_3">&nbsp;&nbsp;Garage</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('garden_3', 1, $unit->garden, ['id' => 'garden_3', 'disabled']) }}
                    <label for="garden_3">&nbsp;&nbsp;Garden</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox custom-checkbox custom-checkbox-teal">
                    {{ Form::checkbox('elevator_3', 1, $unit->elevator, ['id' => 'elevator_3', 'disabled']) }}
                    <label for="elevator_3">&nbsp;&nbsp;Elevator</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-5 control-label text-left" for="number_of_elevators_3">Number Of Elevators:</label>
                <label class="col-sm-7 control-label control-label-value">{{ $unit->number_of_elevators }}</label>
            </div>
        </div>
    </div>
</div>