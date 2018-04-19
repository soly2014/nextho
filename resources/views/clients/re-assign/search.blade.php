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
							<form action="{{ route('search-reassign-selection') }}" method="post" class="form-horizontal" id="ReassignSearch" data-parsley-validate>
				                <div class="row">
				                    <div class="col-md-6">
				                    	<div class="form-group">
				                            <label class="col-sm-3 control-label" for="company">Lead Source:</label>
				                            <div class="col-sm-9">
				                                <select name="lead_source" class="form-control input-sm">
				                                    @foreach(App\Models\ClientSource::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray() as $k=>$v)
				                                        <option value="{{ $k }}">{{ $v }}</option>
				                                    @endforeach
				                                </select>                                                                
				                            </div>
				                        </div>    
				                    </div>
				                    <div class="col-md-6">
				                    	<div class="form-group">
				                            <label class="col-sm-3 control-label" for="company">Lead Status:</label>
				                            <div class="col-sm-9">
				                                <select name="lead_status" class="form-control input-sm">
				                                    @foreach(\App\Models\ClientStatus::Where('published', '=', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id')->toArray() as $k=>$v)
				                                          <option value="{{ $k }}">{{ $v }}</option>
				                                    @endforeach
				                                </select>                                
				                            </div>
				                        </div>    
				                    </div>
				                    <div class="col-md-6">
				                    	<div class="form-group">
				                            <label class="col-sm-3 control-label" for="company">Property Type Interested In:</label>
				                            <div class="col-sm-9">
		                                        <select name="interested_type" class="form-control input-sm minor">
		                                            @foreach(\App\Models\UnitType::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id') as $k=>$V)
		                                                <option value="{{ $k }}">{{ $V }}</option>
		                                            @endforeach
		                                        </select>
				                            </div>
				                         </div>  
				                    </div>
				                    <div class="col-md-6">
				                    	<div class="form-group">
				                            <label class="col-sm-3 control-label" for="company">District Interested In:</label>
				                            <div class="col-sm-9">
		                                        <select name="interested_district" class="form-control input-sm minor">
		                                            @foreach(\App\Models\ProjectDistrict::Where('published', 1)->orderBy('sort_order', 'ASC')->pluck('label', 'id') as $k=>$V)
		                                                <option value="{{ $k}}">{{ $V }}</option>
		                                            @endforeach
		                                        </select>
				                            </div>
				                        </div>   
				                    </div>
				                    <div class="clearfix"></div>
				                    <div class="col-md-2">
				                    	<div class="form-group">
				                            <label class="col-sm-9 control-label" for="company">Customer:</label>
				                            <div class="col-sm-3">
				                                <input type="checkbox" class="form-control input-sm pull-left" name="is_customer">
				                            </div>
				                        </div>   
				                    </div>
				                    <div class="col-md-2">
				                    	<div class="form-group">
				                            <label class="col-sm-9 control-label" for="company">No Action:</label>
				                            <div class="col-sm-3">
				                                <input type="checkbox" class="form-control input-sm pull-left" name="no_action">
				                            </div>
				                        </div>   
				                    </div>
				                    <div class="col-md-2">
				                    	<div class="form-group">
				                            <label class="col-sm-9 control-label" for="company">Expired:</label>
				                            <div class="col-sm-3">
				                                <input type="checkbox" class="form-control input-sm pull-left" name="expired">
				                            </div>
				                        </div>   
				                    </div>
				                </div>
				                <input type="hidden" name="leads_ids" value="{{ json_encode($leads) }}">
				                <input type="hidden" name="assign_to" value="{{ $assign_to }}">
								{{ csrf_field() }}
							</form>
				        </div>
						<div class="panel-footer">
							<div class="form-group no-border">
								<label class="col-sm-3 control-label">Submit</label>
								<div class="col-sm-9">
									<button name="submit" form="ReassignSearch" value="save" type="submit" class="btn btn-primary">Search</button>
									<button name="reset" value="save" type="reset" class="btn btn-danger">Reset</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
