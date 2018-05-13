<h4>Project</h4>
<div class="row">
			<div class="col-md-2">
				<input type="text" id="project_id" class="form-control input-sm" style="margin-bottom:5px;" placeholder="Project ID"
                       value="<?php if(isset($data->data_project_id)){ echo $data->data_project_id; } ?>"/>
			</div>
			<div class="col-md-2">
				<input type="text" id="project_name" class="form-control input-sm" style="margin-bottom:5px;" placeholder="Project Name"
                       value="<?php if(isset($data->data_project_name)){ echo $data->data_project_name; } ?>"/>
			</div>

	        <div class="col-md-2" style="margin-bottom:5px;">
					<?php if(isset($data->data_status_selected)){ ?>
					<input type="hidden" value="<?php echo $data->data_status_selected; ?>" id="status_id"/>
					<?php } ?>
					<select class="form-control input-sm" id="status" name="status" onchange="loadingListBidSearch()">
						<option value="">-- Status --</option>
						<?php
						foreach ($data->data_status as $key => $value) { ?>
						<option value="<?php echo $value->status_id; ?>"><?php echo $value->status_name; ?></option>
						<?php } ?>
					</select>
			</div>

			<div class="col-md-2">
				<button type="submit" class="btn btn-sm btn-default" onclick="loadingListBidSearch()"> <i class="fa fa-search"></i> Search</button>
			</div>


</div>
<br />
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Project Owner</th>
			<th>Posted Date</th>
			<th>Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>

    <?php
    foreach ($data->data_project_list as $key => $items) { ?>
		<tr>
					<td>K<?php echo $items->id; ?> </td>
					<td><?php echo $items->name; ?></td>
			        <td> <a href="/profile/<?php echo $items->user_id; ?>"> <?php echo $items->username; ?> </a></td>
					<td><?php echo $items->created_at; ?></td>
					<?php if($items->status=="open"){ ?>
							<td><a href="#" class="btn btn-xs alert-info" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }else if($items->status=="offered"){  ?>
						   <td><a href="#" class="btn btn-xs alert-warning" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }else {  ?>
						   <td><a href="#" class="btn btn-xs alert-danger" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }  ?>
					<td class="text-center">
                        <?php if($items->status=="open"){ ?>
							<a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#<?php echo $items->id; ?>">Edit</a>
						<?php }else{  ?>
							<a disabled href="#" class="btn btn-xs btn-success" > Edit </a>
							<?php }   ?>
						<a href="/freelancer/project_detail_open/<?php echo $items->id; ?>" class="btn btn-xs btn-success">View</a>
					</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>





<!-- Modal Bid Project-->

<?php
foreach ($data->data_project_list as $key => $items) { ?>

<div class="modal fade" id="<?php echo $items->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Offer to work on this project now!</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" id="bid_project_id_<?php echo $items->id; ?>" method="POST" action="<?php echo $data->url_bid_project; ?>" >

					<input type="hidden" name="_token" value="{{ csrf_token() }}" >
					<input  type="hidden" name="project_id" value="<?php echo $items->id ?>" />
					<input  type="hidden" name="bid_project_id" value="<?php echo $items->bid_project_id; ?>" />
					<input  type="hidden" name="bid_project_budget_id" value="<?php echo $items->bid_project_budget_id; ?>" />
					<input  type="hidden" name="bid_project_timeframe_id" value="<?php echo $items->bid_project_timeframe_id; ?>" />

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Project Timeframe</label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-md-4">
									<input id="timeframe_id" type="hidden" value="3" />
									<select class="form-control" name="timeframe" id="timeframe">
											<?php
											foreach ($data->data_timeframe as $key => $value) { ?>
											<option  value="<?php echo $value->id; ?>" <?php echo (( $value->id ==$items->timeframe_id )? "selected":""); ?> > <?php echo $value->name; ?></option>
											<?php } ?>

									</select>


								</div>
								<div class="col-md-8">

									<div class="form-group{{ $errors->has('timeframe_value') ? ' has-error' : '' }}">
										<div class="col-md-12">
                                            <?php if(isset($items->duration)){ ?>
												<input type="number" name="timeframe_value" id="timeframe-value" class="form-control" min="0" value="<?php echo $items->duration; ?>" placeholder="Number of project timeframe" />
                                            <?php }else { ?>
												<input type="number" name="timeframe_value" id="timeframe-value" class="form-control" min="0" value="{{ old('timeframe_value') }}" placeholder="Number of project timeframe" />
											<?php } ?>
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
									<select class="form-control input-sm" id="currency" name="currency">
                                        <?php
                                        foreach ($data->data_currency as $key => $value) { ?>
											<option  value="<?php echo $value->currency_id; ?>" <?php echo (( $value->currency_id ==$items->currencyid )? "selected":""); ?> > <?php echo $value->currency_name; ?></option>
                                        <?php } ?>
									</select>
								</div>
								<div class="col-md-8">
									<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
										<div class="col-md-12">
											<?php if(isset($items->amount)){ ?>
												<input type="number" name="amount" id="budget" class="form-control" min="0" value="<?php echo $items->amount; ?>" placeholder="Amount will charge on project" />
											<?php }else { ?>
												<input type="number" name="amount" id="budget" class="form-control" min="0" value="{{ old('amount') }}" placeholder="Amount will charge on project" />
											<?php } ?>
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
									<?php if(isset($items->desc)){  ?>
										<textarea class="form-control" name="desc" id="desc" placeholder="Description here ..." style="min-height:200px;max-height:200px;min-width:100%;max-width:100%;"><?php echo $items->desc; ?></textarea>
									<?php }else{ ?>
										<textarea class="form-control" name="desc" id="desc" placeholder="Description here ..." style="min-height:200px;max-height:200px;min-width:100%;max-width:100%;"><?php echo old('desc'); ?></textarea>
									<?php } ?>

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

                                    <?php if(isset($items->contact)){  ?>
										<input type="email"  name="contact" class="form-control" value="<?php echo $items->contact; ?>"  placeholder="Your Phone Number Or Email"  />
                                    <?php }else{ ?>
										<input type="email"  name="contact" class="form-control" value="{{ old('contact') }}"  placeholder="Your Phone Number Or Email"  />
                                    <?php } ?>
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
						<button  class="form-control btn btn-sm btn-success" type="button"  onclick="$('#bid_project_id_<?php echo $items->id;  ?>').submit()" >Update Bid Project</button>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php  }   ?>
;




<script type="text/javascript">


    @if (count($errors) > 0)

       alert("error");

       @endif

$(document).ready(
        function(){


//            var currency_value = $('#currency_id').val();
//            alert(currency_value);
//            $("#currency option[value="+currency_value+"]").attr('selected',true);






            var timeframe_id_value = $('#timeframe_id').val();
            var str = timeframe_id_value.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')
            console.log('ID ='+timeframe_id_value);
            $("#"+str+"").prop('selected',true);

        });


    $("a").on("click", function(event){
        if ($(this).is("[disabled]")) {
            event.preventDefault();
        }
    });


	function loadingListBidSearch() {
			var id = $('#project_id').val();
			var name = $('#project_name').val();
			var status = $( "#status option:selected" ).val();
			$.ajax({
				type: "GET",
				url: "/load-bid-list?id="+id+"&project_name="+name+"&status="+status,
				beforeSend:function() {
				console.log('beforeSend');
					$('#block-loader').show();
				},
				complete:function() {
					console.log('complete');
				$('#block-loader').hide();
				},
				success:function(html) {
					$('#load-page').html(html).show();
				},
				error:function(request, status, error) {
					$('#load-page').html('').show();
				}
			});
			return false;
	}





</script>