@extends('layouts.k_app')


@section('content')


    <div class="row col-sm-12">


        <div class="modal-content">      <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Offer to work on this project now!</h4>
            </div>
            <div class="modal-body">

                    <form class="form-horizontal" id="bid_project_id" method="POST" action="<?php echo $data->url_bid_project; ?>" >

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="project_id" value="{{ old('project_id') }}" />
                        <input type="hidden" name="bid_project_id" value="{{ old('bid_project_id') }}" />
                        <input type="hidden" name="bid_project_budget_id" value="{{ old('bid_project_budget_id') }}" />
                        <input type="hidden" name="bid_project_timeframe_id" value="{{ old('bid_project_timeframe_id') }}" />

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Project Timeframe</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="timeframe_id" type="hidden" value="3" />
                                        <select class="form-control" name="timeframe" id="timeframe">
                                            <?php
                                            foreach ($data->data_timeframe as $key => $value) { ?>
                                            <option  value="<?php echo $value->id; ?>" <?php echo (( $value->id == old('timeframe') )? "selected":""); ?> > <?php echo $value->name; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="form-group{{ $errors->has('timeframe_value') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <input type="number" name="timeframe_value" id="timeframe-value" class="form-control" min="0" value="{{ old('timeframe_value') }}" placeholder="Number of project timeframe" />
                                                @if ($errors->has('timeframe_value'))
                                                    <span hidden class="help-block">
													<strong>{{ $errors->first('timeframe_value') }}</strong>
                                        		</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Your bid budget on this project</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php if(isset($data->data_currency_selected)){ ?>
                                        <input type="hidden" value="<?php echo $data->data_currency_selected; ?>" id="currency_id"/>
                                        <?php } ?>

                                            <select class="form-control input-sm" id="currency" name="currency">
                                                <?php
                                                foreach ($data->data_currency as $key => $value) { ?>
                                                <option  value="<?php echo $value->currency_id; ?>" <?php echo (( $value->currency_id ==old('currency') )? "selected":""); ?> > <?php echo $value->currency_name; ?></option>
                                                <?php } ?>
                                            </select>


                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <input type="number" name="amount" id="budget" class="form-control" min="0" value="{{ old('amount') }}" placeholder="Amount will charge on project" />
                                                @if ($errors->has('amount'))
                                                    <span hidden class="help-block">
													<strong>{{ $errors->first('amount') }}</strong>
                                        		</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tell project owner about your related skill or what you will do on this project</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="desc" id="desc" placeholder="Description here ..." style="min-height:200px;max-height:200px;min-width:100%;max-width:100%;"><?php echo old('desc'); ?></textarea>
                                        @if ($errors->has('desc'))
                                            <span hidden class="help-block">
													<strong>{{ $errors->first('desc') }}</strong>
                                        		</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Give your contact to project owner</label>
                            <div class="col-sm-9">

                                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input type="email"  name="contact" class="form-control" value="{{ old('contact') }}"  placeholder="Your Phone Number Or Email"  />
                                        @if ($errors->has('contact'))
                                            <span hidden class="help-block">
													<strong>{{ $errors->first('contact') }}</strong>
                                        		</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

            </div>


            <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-9 text-left">
                            <i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Other information you can contact to project owner via chat.
                        </div>
                        <div class="col-md-3">
                            <button  class="form-control btn btn-sm btn-success" type="button"  onclick="$('#bid_project_id').submit()" >Update Bid Project</button>
                        </div>
                    </div>
            </div>
        </div>

</div>


@endsection
