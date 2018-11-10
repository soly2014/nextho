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
						<form action="{{ route('leads-search-post') }}" method="post" class="form-horizontal" data-parsley-validate>






			                <div class="row">
			                    <div class="col-md-6">
			                        @if($errors->has('name'))
			                        <div class="form-group has-error">
			                        @else
			                        <div class="form-group">
			                        @endif
			                            <label class="col-sm-3 control-label" for="name">Name <span class="text-danger">*</span>:</label>
			                            <div class="col-sm-9">			                                    
			                                    <!-- /btn-group -->
			                                    <input type="text" class="form-control input-sm" name="name" id="name"{{ (old('name') ? '  value="'.e(old('name')).'"' : '') }} data-parsley-required>
			                                    @if($errors->has('name'))
			                                    <div class="help-block">{{ $errors->first('name') }}</div>
			                                    @endif
			                                <!-- /input-group -->
			                            </div>
			                        </div>
			                        @if($errors->has('company'))
			                        <div class="form-group has-error">
			                        @else
			                        <div class="form-group">
			                        @endif
			                            <label class="col-sm-3 control-label" for="company">Company:</label>
			                            <div class="col-sm-9">
			                                <input type="text" class="form-control input-sm" name="company" id="company"{{ (old('company') ? '  value="'.e(old('company')).'"' : '') }}>
			                                @if($errors->has('company'))
			                                <div class="help-block">{{ $errors->first('company') }}</div>
			                                @endif
			                            </div>
			                        </div>

			                        @if($errors->has('mobile'))
			                        <div class="form-group has-error">
			                        @else
			                        <div class="form-group">
			                        @endif
			                            <label class="col-sm-3 control-label" for="mobile">Mobile OR Phone:</label>
			                            <div class="col-sm-9">
			                                <input type="text" class="form-control input-sm" name="mobile" id="mobile" value="{{ old('mobile') ? old('mobile') : '' }}" >
			                                @if($errors->has('mobile'))
			                                <div class="help-block">{{ $errors->first('mobile') }}</div>
			                                @endif
			                            </div>
			                        </div>



			                        @if($errors->has('email'))
			                        <div class="form-group has-error">
			                        @else
			                        <div class="form-group">
			                        @endif
			                            <label class="col-sm-3 control-label" for="email">Email:</label>
			                            <div class="col-sm-9">
			                                <input type="text" class="form-control input-sm" name="email" id="email" data-parsley-type="email"{{ (old('email') ? '  value="'.e(old('email')).'"' : '') }}>
			                                @if($errors->has('email'))
			                                <div class="help-block">{{ $errors->first('email') }}</div>
			                                @endif
			                            </div>
			                        </div>



			                        <div class="row">

			                           <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="project_id">Projects:</label>
			                                    <div class="col-sm-9">
			                                        <select name="project_id[]" id="e1" class="form-control input-sm minor" multiple>
			                                            @foreach(\App\Models\ParameterProject::all() as $V)
			                                                <option value="{{ $V->id }}">{{ $V->name }}</option>
			                                            @endforeach
			                                        </select>
			                                        @if($errors->has('project_id'))
			                                    <div class="help-block" style="color: red;">{{ $errors->first('project_id') }}</div>
			                                    @endif
			                                    </div>
			                                </div>
			                            </div>
                                         @if($users && auth()->user()->role_id == '1')
			                             <div class="col-sm-12">
			                                 <div class="form-group">
			                                    <label class="col-sm-3 control-label" for="assign_to">Assign To:</label>
			                                    <div class="col-sm-9">
			                                        <select name="assign_to" class="form-control input-sm minor">
			                                            @foreach($users as $k=>$v)
			                                               <option value="{{ $k }}">{{ $v }}</option>
			                                            @endforeach
			                                        </select>
			                                    </div>
			                                </div>
			                             </div>
			                             @endif

			                        </div>

                                       <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="developer_id">Developers:</label>
			                                    <div class="col-sm-9">
			                                        <select name="developer_id[]" id="e2" class="form-control input-sm minor" multiple>
			                                                <option value="">--None--</option>
			                                            @foreach(\App\Models\Developer::all() as $v)
			                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
			                                            @endforeach
			                                        </select>
			                                        @if($errors->has('developer_id'))
			                                    <div class="help-block" style="color: red;">{{ $errors->first('developer_id') }}</div>
			                                    @endif
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="interested_type">Badget:</label>
			                                    <div class="col-sm-9">
			                                        <input type="number" name="from" placeholder="From" class="form-control" style="width: 49%!important;display: inline!important;">
			                                        <input type="number" name="to" placeholder="To" class="form-control" style="width: 49%!important;display: inline!important;">
			                                    </div>
			                                </div>
			                            </div>

			                    </div>
			                    <div class="col-md-6">


			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="lead_status">Lead Status:</label>
			                            <div class="col-sm-9">
			                                <select name="lead_status" class="form-control input-sm">
			                                    @foreach($lead_status as $k=>$v)
			                                          <option value="{{ $k }}">{{ $v }}</option>
			                                    @endforeach
			                                </select>                                
			                                @if($errors->has('lead_status'))
			                                <div class="help-block" style="color: red;">{{ $errors->first('lead_status') }}</div>
			                                @endif
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="lead_source">Lead Source:</label>
			                            <div class="col-sm-9">
			                                <select name="lead_source" class="form-control input-sm">
			                                    @foreach($lead_source as $k=>$v)
			                                        <option value="{{ $k }}">{{ $v }}</option>
			                                    @endforeach
			                                </select>                                                                
			                                @if($errors->has('lead_source'))
			                                <div class="help-block" style="color: red;">{{ $errors->first('lead_source') }}</div>
			                                @endif
			                            </div>
			                        </div>


			                        <!-- MY EDIT START -->
			                        <div class="form-group">
			                            <label class="col-sm-3 control-label" for="lead_status">Rent/Buyer/seller:</label>
			                            <div class="col-sm-9">
			                                <select name="cat" class="form-control">
			                                    @foreach(array('1' => '-None-', 'Rent' => 'Wanna Rent', 'Buyer' => 'Buyer', 'Seller' => 'Seller', 'Renter' => 'Has Property To Rent') as $k=>$v)
			                                      <option value="{{ $k }}">{{ $v }}</option>
			                                    @endforeach
			                                </select>
			                                @if($errors->has('cat'))
			                                <div class="help-block" style="color: red;">{{ $errors->first('cat') }}</div>
			                                @endif
			                            </div>
			                        </div>
			                        <!-- MY EDIT END -->
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="interested_district">District Interested In:</label>
			                                    <div class="col-sm-9">
			                                        <select name="interested_district" class="form-control input-sm minor">
			                                            @foreach($districts as $k=>$V)
			                                                <option value="{{ $k}}">{{ $districts[$k] }}</option>
			                                            @endforeach
			                                        </select>
			                                    	@if($errors->has('interested_district'))
				                                <div class="help-block" style="color: red;">{{ $errors->first('interested_district') }}</div>
				                                @endif
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="interested_type">Property Type Interested In:</label>
			                                    <div class="col-sm-9">
			                                        <select name="interested_type" class="form-control input-sm minor">
			                                            @foreach($types as $k=>$V)
			                                                <option value="{{ $k }}">{{ $types[$k] }}</option>
			                                            @endforeach
			                                        </select>
			                                        @if($errors->has('interested_type'))
			                                    <div class="help-block" style="color: red;">{{ $errors->first('interested_type') }}</div>
			                                    @endif
			                                    </div>
			                                </div>
			                            </div>
			                   

			                            <div class="col-sm-12">
			                                <div class="form-group">
			                                    <label class="col-sm-3 control-label text-right" for="interested_type">Date:</label>
			                                    <div class="col-sm-9">
			                                        <input type="text" name="start_date" placeholder="From" class="form-control full-date-picker" style="width: 49%!important;display: inline!important;">
			                                        <input type="text" name="end_date" placeholder="To" class="form-control full-date-picker" style="width: 49%!important;display: inline!important;">
			                                    </div>
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