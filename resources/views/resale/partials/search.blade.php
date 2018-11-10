<div class="col-sm-12">
	<div class="panel-group" id="accordion1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" class="collapsed">
					<span class="arrow mr5"></span> Search
				</a>
			</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="col-sm-12">
						<form action="{{ route('resales.search') }}" method="get" class="form-horizontal" data-parsley-validate>

			                <div class="row">

			                    <div class="col-md-6">

			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="email">Property Type:</label>
			                            <div class="col-sm-9">
		                                    <select name="property_type" class="form-control input-sm">
		                                        @foreach($types = \App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray() as $k=>$V)
		                                            <option value="{{ $k }}">{{ $types[$k] }}</option>
		                                        @endforeach
		                                    </select>
			                            </div>
			                        </div>
            
			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="name">Sale Type <span class="text-danger">*</span>:</label>
			                            <div class="col-sm-9">			                                    
		                                    <select name="sale_type" class="form-control input-sm">
		                                          <option value="none">=======</option>
		                                        @foreach(array( 'sale' => 'For Sale', 'rent' => 'For Rent') as $k=>$v)
		                                          <option value="{{ $k }}">{{ $v }}</option>
		                                        @endforeach
		                                    </select>
			                            </div>
			                        </div>


			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="status">Finishing:</label>
			                            <div class="col-sm-9">
		                                   <select name="status" class="form-control input-sm">                                    
		                                            <option value="none">=======</option>
			                                    @foreach(\App\Models\Finish::Where('published', 1)->orderBy('sort_order', 'ASC')->get() as $obj)
			                                        <option value="{{ $obj->id }}">{{ $obj->label }}</option>
			                                    @endforeach
      		                                </select>
			                            </div>
			                        </div>


			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="mobile">Location:</label>
			                            <div class="col-sm-9">
		                                    <select name="location_id" class="form-control input-sm ">
		                                        @foreach($districts =\App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id') as $k=>$V)
		                                            <option value="{{ $k}}">{{ $districts[$k] }}</option>
		                                        @endforeach
		                                    </select>
			                            </div>
			                        </div>



			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="email">ID:</label>
			                            <div class="col-sm-9">
			                                <input type="number" class="form-control input-sm" name="id" id="id" data-parsley-type="id">
			                            </div>
			                        </div>

			                   </div> <div class="col-md-6">

			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="email">Project Name:</label>
			                            <div class="col-sm-9">
		                                    <select name="project_id" class="form-control input-sm ">
		                                            <option value="none">=======</option>
		                                        @foreach(\App\Models\ParameterProject::all() as $V)
		                                            <option value="{{ $V->id }}">{{ $V->name }}</option>
		                                        @endforeach
		                                    </select>
			                            </div>
			                        </div>


		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label class="col-sm-3 control-label text-right" for="interested_type">Unit Price:</label>
		                                    <div class="col-sm-9">
		                                        <input type="number" name="unit_price_from" placeholder="From" class="form-control" style="width: 49%!important;display: inline!important;">
		                                        <input type="number" name="unit_price_to" placeholder="To" class="form-control" style="width: 49%!important;display: inline!important;">
		                                    </div>
		                                </div>
		                            </div>


		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label class="col-sm-3 control-label text-right" for="interested_type">Down Payment:</label>
		                                    <div class="col-sm-9">
		                                        <input type="number" name="down_payment_from" placeholder="From" class="form-control" style="width: 49%!important;display: inline!important;">
		                                        <input type="number" name="down_payment_to" placeholder="To" class="form-control" style="width: 49%!important;display: inline!important;">
		                                    </div>
		                                </div>
		                            </div>



		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label class="col-sm-3 control-label text-right" for="interested_type">Delivery Date:</label>
		                                    <div class="col-sm-9">
		                                        <input type="text" name="delivery_date" placeholder="delivery date" class="form-control full-date-picker">
		                                    </div>
		                                </div>
		                            </div>



			                    </div>

			                </div>


							<div class="panel-footer">
								<div class="form-group no-border">
									<label class="col-sm-3 control-label">Submit</label>
									<div class="col-sm-9">
										<button name="submit" value="save" type="submit" class="btn btn-primary">Search</button>
										<button name="reset" value="save" type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>