@extends('common.master')

@section('breadcrumbs')

@include('common.breadcrumbs')

@stop

@section('content')

<div class="col-sm-12">
	{{-- Form::model($sale, ['method' => 'PUT', 'route' => ['sales-modify-single-post', $sale->id], 'class' => 'form-horizontal', 'data-parsley-validate']) --}}
	<form action="{{ route('sales-modify-single-post', $sale->id) }}" method="post" class="form-horizontal" data-parsley-validate>
		{{ method_field('PUT') }}
		{{ csrf_field() }}
        <div class="panel panel-default unit-form">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ico-refresh mr10"></i>Modify Sale</h3>
            </div>
            <div class="panel-body">
				@if($sale->propertable_type == "Project")
                <div class="row">
                    <div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-12 control-label text-left" for="project">Project:</label>
							<div class="col-sm-12">
								{{-- Form::select('project', $all_projects, $sale->project_id, array('class' => 'form-control input-sm minor')); --}}
								<select class="form-control input-sm minor" name="project">
									@foreach($all_projects as $k=>$v)
									  <option value="{{ $k }}" {{ $k== $sale->project_id ? 'selected' : '' }}>{{ $v }}</option>
									@endforeach  
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label text-left" for="unit">Unit Type:</label>
							<div class="col-sm-12">
								{{-- Form::select('unit', $all_units, $sale->saleInfo->unit_type, array('class' => 'form-control input-sm minor')); --}}
								<select class="form-control input-sm minor" name="unit">
									@foreach($all_units as $k=>$v)
									  <option value="{{ $k }}" {{ $k== $sale->saleInfo->unit_type ? 'selected' : '' }}>{{ $v }}</option>
									@endforeach  
								</select>
							</div>
						</div>
                    </div>
                    <div class="col-sm-6">
						<div class="form-group">
                    		<label class="control-label col-sm-12 text-left" for="unit_area">Unit Area</label>
							<div class="form-control-group col-sm-12">
								<div class="input-group input-group-sm full-width">
									{{-- Form::text('unit_area', $sale->saleInfo->unit_area, ['id' => 'unit_area', 'class' => 'form-control unit_area input-sm', 'data-parsley-required' => 'true']) --}}
									<input type="text" name="unit_area" class="form-control unit_area input-sm" id="unit_area" value="{{  $sale->saleInfo->unit_area }}" data-parsley-required>
									<span class="input-group-addon">m<sub>2</sub></span>

								</div>
								@if($errors->has('unit_area'))
								<div class="help-block">{{ $errors->first('unit_area') }}</div>
								@endif
							</div>
                    	</div>
						<div class="form-group">
							<label class="control-label col-sm-12 text-left" for="sold_price">Sold Price</label>
							<div class="form-control-group col-sm-12">
								<div class="input-group input-group-sm full-width">
									{{-- Form::text('sold_price', $sale->price, ['id' => 'sold_price', 'class' => 'form-control input-sm', 'data-parsley-required' => 'true']) --}}
									<input type="text" name="sold_price" class="form-control input-sm" id="sold_price" value="{{ $sale->price }}" data-parsley-required>
									<span class="input-group-addon">EGP</span>
								</div>
								@if($errors->has('sold_price'))
								<div class="help-block">{{ $errors->first('sold_price') }}</div>
								@endif
							</div>
						</div>
                    </div>
                </div>
				<input type="hidden" name="type_project" value="1">
				@else
				
				@endif
            </div>
			<div class="panel-footer">
                <div class="form-group no-border">
                    <label class="col-sm-3 control-label">Submit</label>
                    <div class="col-sm-9">
                        <button name="submit" value="save" type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('sales-view') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
	</form> 
</div> 

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('public/plugins/parsley/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/javascript/utils/forms.js') }}"></script>
@stop