@extends('layouts.app')

@section('css')
	<style type="text/css">
		.alert-fixed {
			position:fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			z-index:9999;
			border-radius:0px
		}

		.required:after {
			color: red;
			content:" *";
		}



	</style>
@endsection

@section('content')

    <?php

    function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }


        function splitStringSecondFunction($str){
            $matches = preg_split('/\--/', $str);
            $first = isset($matches[0]) ? $matches[0] : '';
            $second = isset($matches[1]) ? $matches[1] : '';
            return $second;
        }


    }

    ?>

	@if(Session::has('flash_message'))
		<div id="successMessageOffered" class="alert-fixed alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
	@endif
	<div class="panel panel-success">
		<div class="panel-heading">
			<ol class="breadcrumb">
				<li><a href="search_project.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to page search project"></i></a></li>
				<li><a href="home.php">Home</a></li>
				<li class="active">Project's Detail</li>
			</ol>
		</div>
        <?php
        foreach ($data->data_project_detail as $key => $value) { ?>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-8">
							<strong> <?php echo $value->name; ?> </strong>
						</div>
						<div class="col-md-2">
							Project ID: # <?php echo $value->id; ?>
						</div>
						<div class="col-md-2 text-center">
                            <?php if($value->status == "open") {  ?>
							<div class="alert alert-xs alert-info" role="alert"><strong>Open</strong></div>
                            <?php }else if($value->status == "offered") { ?>
							<div class="alert alert-xs alert-warning" role="alert"><strong>Offered</strong></div>
                            <?php }else if($value->status == "close") { ?>
							<div class="alert alert-xs alert-danger" role="alert"><strong>Close</strong></div>
                            <?php	}  ?>
						</div>
					</div>
					<hr />
					<h5>Description</h5>
					<p class="box-text">
                        <?php echo $value->desc; ?>
					</p>
					<br />
					<h5>Files Attached</h5>
					<table class="">
						<tbody>
						<tr>
							<td><a href="#"><i class="fa fa-image"></i> <span style="font-size:12px;"><?php echo $value->file_name; ?></span></a></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						</tbody>
					</table>
					<h5>Required Skills</h5>
					<div>
                        <?php
                        if(isset($value->project_skill)){
                        $arr = explode(",",$value->project_skill);
                        foreach ($arr as $item) { ?>
						<a href="#" class="btn btn-xs btn-default"><?php echo preg_split('/\--/', $item)[1] ?></a>
                        <?php } } ?>

					</div>
					<br />
					<a href="#" class="btn btn-sm btn-success">Post a Project Like This</a>
					<br /><br />
				</div>
				<div class="col-md-4">
					<strong>Posted By</strong>
					<div class="media user-chat-box">
						<div class="media-left media-top">

							<img class="media-object img-thumbnail" src="<?php echo url($value->profile); ?>" style="width:50px;" alt="name">

						</div>
						<div class="media-body">
							<div>
                                <?php echo $value->username; ?>
							</div>
							<div class="media-skill">
                                <?php
                                $cnt = 0;
                                foreach ($data->list_skill as $key => $item) {
                                    $cnt++;
                                    if($cnt == 3){
                                        echo $item->skill_title.'...';
                                    }else{
                                        echo $item->skill_title.', ';
                                    }
                                    if ($cnt == 3) break;  //for limit
                                }
                                ?>
							</div>
							<div>
								<span><a href="#">Chat</a></span> | <span><a href="{{ url($data->url_profile.'/'.$value->user_id) }}">View Profile</a></span></p>
							</div>
						</div>
					</div>
					<br /><br />
					<p><strong>Posted: </strong><?php echo humanTiming(strtotime($value->created_at)); ?> ago</p>
					<p><strong>Project Budget :</strong>

                        <?php if($value->currency==2){ ?>
				<?php echo $value->min.'KHR - '.$value->max.'KHR'; ?>
                <?php }else{ ?>
				 <?php echo '$'.$value->min.' - $'.$value->max; ?>
                <?php } ?>
					</p>
                    <?php
                    $items = array();
                    foreach($data->data_list_bid_project as $item) {
                        if($item->currency_name == "KHR"){
                            $items[] = $item->amount/4000;
                        }else{
                            $items[] = $item->amount;
                        }
                    }
                    if(count($items)>0){
                    $average = array_sum($items) / count($items);
                    }
                    ?>
					<p><strong>Avg Bid:</strong> $<?php  if(isset( $average)){ echo round($average,2); } ?></p>
					<p><strong>Biding:</strong> <?php echo count($data->data_list_bid_project); ?></p>
					<hr />
					<div>
						<?php if($value->user_id == $data->data_user_id){  ?>
                            <?php if($value->status == "open") {  ?>
								<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#close_project_modal">Close This Project</button>
						<?php }else if($value->status == "offered") { ?>
								<button disabled class="btn btn-sm btn-success" data-toggle="modal" data-target="#close_project_modal">Close This Project</button>
						<?php }else if($value->status == "close") { ?>
								<button disabled class="btn btn-sm btn-success" data-toggle="modal" data-target="#close_project_modal">Close This Project</button>
						<?php	}  ?>

						<?php }else{  ?>

                            <?php if($value->status == "open") {  ?>
							<span><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#bid_project_modal">Bid On This Project Now</a></span>
                            <?php }else if($value->status == "offered") { ?>
							<span><a href="#"  class="btn btn-sm btn-success" data-toggle="modal" data-target="#bid_project_modal">Bid On This Project Now</a></span>
                            <?php }else if($value->status == "close") { ?>
							<a href="#" disabled  class="btn btn-sm btn-success">Bid On This Project Now</a>
							<?php }  ?>

						<?php } ?>


					</div>
				</div>
			</div>
		</div>
	</div>

    <?php } ?>


	<?php if(count($data->data_list_bid_project)> 0){ ?>

	   <div class="col-md-8 col-md-offset-2">
		<div class="panel panel-info">
			<div class="panel-heading">
                <?php
                $items = array();
                foreach($data->data_list_bid_project as $item) {
                    if($item->currency_name == "KHR"){
                        $items[] = $item->amount/4000;
                    }else{
                        $items[] = $item->amount;
                    }
                }

                if(count($items)>0){
                    $average = array_sum($items) / count($items);
                }

                ?>


				<h5><?php echo count($data->data_list_bid_project); ?> freelancers are bidding on this project for average amount : $ <?php   if(isset($average)){ echo round($average,2); }  ?></h5>
			</div>
			<div class="panel-body">

                <?php
                foreach ($data->data_list_bid_project as $key => $items) { ?>

				<div class="media">
					<div class="media-left media-top">
						<a href="#">
							<img class="media-object img-thumbnail" src="<?php echo url('/').'/'.$items->profile; ?>" style="width:70px;" style="width:70px;" alt="name">
						</a>
					</div>
					<div class="media-body">
						<div class="row">
							<div class="col-md-7">
								<div>
									<strong><?php echo $items->username; ?></strong>
								</div>
								<br />
								<p>
                                    <?php echo $items->desc;  ?>
								</p>
								<div>

									<span><a href="#">Chat</a></span> | <span><a href="<?php echo url($data->url_profile.'/'.$items->user_id); ?>">View Profile</a></span></p>


								</div>

							</div>
							<div class="col-md-5 text-right">
								<p><strong><?php echo $items->amount.' '.$items->currency_name;  ?> </strong> in <?php echo $items->duration.' '.$items->timeframe;  ?></p>
								<div>

									<span style="padding: 3px; background:#5cb85c; color:#fff;">5.0</span>&nbsp;
									<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
									<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
									<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
									<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
									<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>
									&nbsp;&nbsp; <span>(3 Reviews)</span>
								</div>
								<br />
								<div>

                                    <?php
                                    foreach ($data->data_project_detail as $key => $items) { ?>
                                    <?php if($items->user_id == $data->data_user_id){  ?>
									<button class="btn btn-sm btn-success" data-toggle="modal" data-target="<?php echo '#'.$items->user_id; ?>">Offer This Project</button>
								    <?php }} ?>
								</div>
							</div>

						</div>
					</div>
				</div>
				<br />
				<?php  } ?>
			</div>
		</div>

	</div>

    <?php } ?>



	<!-- Modal Bid Project-->


	<div class="modal fade" id="bid_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">      <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Offer to work on this project now!</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="bid_project_form" method="POST" action="<?php echo $data->url_bid_project; ?>" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}" >
						<input  type="hidden" name="project_id" value="<?php echo $data->project_id ?>" />
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Project Timeframe</label>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-md-4">
										<select class="form-control" name="timeframe">
											<option value="1">Day</option>
											<option value="2">Week</option>
											<option value="3">Month</option>
											<option value="4">Year</option>
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
										<select class="form-control" name="currency">
											<option value="1">USD</option>
											<option value="2">KHR</option>
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
										<input type="email"  name="contact" class="form-control" value="{{ old('contact') }}"  placeholder="Your Phone Number Or Email" autofocus />
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
							<button  class="form-control btn btn-sm btn-success" type="button"  onclick="$('#bid_project_form').submit();" >Bid Project</button>
						</div>
					</div>
				</div>

			</div>
		</div>


	</div>




	<!-- Modal -->

    <?php
    foreach ($data->data_list_bid_project as $key => $items) { ?>
	<div class="modal fade" id="<?php echo $items->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Offer Confirmation!</h4>
				</div>
				<div class="modal-body">
					Offer this project to freelancer
					<br />
					<div class="media">
						<div class="media-left media-top">

							<a href="#">
								<img class="media-object img-thumbnail" src="<?php echo url('/').'/'.$items->profile; ?>" style="width:70px;" style="width:70px;" alt="name">
							</a>
						</div>
						<div class="media-body">
							<div class="row">
								<div class="col-md-7">
									<div>
										<strong><?php echo $items->username;  ?></strong>
									</div>
									<br />
									<p>
                                        <?php echo $items->desc;  ?>
									</p>
								</div>
								<div class="col-md-5 text-right">
									<p><strong><?php echo $items->amount.' '.$items->currency_name;  ?> </strong> in <?php echo $items->duration.' '.$items->timeframe;  ?></p>
									<div>
										<span style="padding: 3px; background:#5cb85c; color:#fff;">4.0</span>&nbsp;
										<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
										<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
										<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
										<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
										<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>
									</div>
									<div><span>(5 Reviews)</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-9 text-left">
							<i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Other information you can contact to freelancer via chat.
						</div>
						<div class="col-md-3">
							<form class="form-horizontal" id="<?php echo $items->id;  ?>" method="POST" action="<?php echo $data->url_offered_project; ?>" >
								<input type="hidden" name="_token" value="{{ csrf_token() }}" >
								<input  type="hidden" name="project_id" value="<?php echo $data->project_id ?>" />
								<input type="hidden" name="bid_id" value="<?php echo $items->id;  ?>" >
							</form>
							<button type="button" class="btn btn-success" onclick="$('#'+'<?php echo $items->id;  ?>').submit();">Offer Project</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php } ?>







   <!--Clode project modal -->

	<div class="modal fade" id="close_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Close Confirmation!</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="close_project_form" method="POST" action="<?php echo $data->url_close_project; ?>" >

						<input type="hidden" name="_token" value="{{ csrf_token() }}" >
						<input  type="hidden" name="project_id" value="<?php echo $data->project_id ?>" />

					<div class="row" style="padding:10px; background: rgba(95,180,250,0.84); border-radius:0px; margin-bottom:15px;">
						<div class="col-md-7">
							<div>
								<strong>Do you want to close this project?</strong>
							</div>
						</div>
					</div>

					<div>
						<div class="row">
							<?php foreach ($data->data_user_offered as $key => $value) { ?>
							<input  type="hidden" name="offered_user_id" value="<?php echo $value->user_id ?>" />

							<div class="col-md-12">
								<label class="control-label" for="input-review">Review for freelancer</label>
								<div class="media user-chat-box">
									<div class="media-left media-top">
										<img class="media-object img-thumbnail" src="<?php echo url($value->profile); ?>" style="width:50px;" alt="name">
									</div>
									<div class="media-body">
										<div class="media-name">
											<?php echo $value->username; ?>
										</div>
										<div class="media-skill">
                                            <?php
                                            $cnt = 0;
                                            $arr = explode(",",$value->user_skill);
                                            foreach ($arr as $key => $item) {
												$cnt++;
												if($cnt == count($arr)){
													echo preg_split('/\--/', $item)[1];
												}else{
													echo preg_split('/\--/', $item)[1].', ';
												}
                                            }
                                            ?>
										</div>
									</div>
								</div>
								<br/>
							<?php } ?>

							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
									<div class="form-group">
										<div class="col-sm-10">
										<label  class="control-label required" for="input-review">Your Review</label>
										</div>
										<div class="col-sm-12">
											<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
												<div class="col-md-12">
													<textarea class="form-control" name="desc"  rows="5" id="input-review" placeholder="Comment here ..." style="min-height:200px;max-height:200px;min-width:100%;max-width:100%;"><?php echo old('desc'); ?></textarea>
													@if ($errors->has('desc'))
														<span hidden class="help-block">
															<strong>{{ $errors->first('desc') }}</strong>
														</span>
													@endif
												</div>
											</div>
										</div>
							</div>
							</div>


							<div class="col-sm-12" style="margin-top: 10px;">

								<div class="form-group">
									<div class="col-sm-10">
										<label class="control-label required" for="input-review">Rating</label>
									</div>
									<div class="col-sm-12">
										<div class="form-group{{ $errors->has('rate_num') ? ' has-error' : '' }}">
											<div class="col-md-12">
												<input name="rate_num" id="rating-input" type="text" title="" data-size="sm" value="<?php echo old('rate_num'); ?>"/>
												@if ($errors->has('rate_num'))
													<span hidden class="help-block">
															<strong>{{ $errors->first('rate_num') }}</strong>
														</span>
												@endif
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>

					</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success" onclick="$('#close_project_form').submit();">Close Project</button>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">

		@if (count($errors) > 0)
             <?php
                foreach ($data->data_project_detail as $key => $items) { ?>
						   <?php if($items->user_id == $data->data_user_id){  ?>
								   $('#close_project_modal').modal('show');
						   <?php }else{  ?>
								  $('#bid_project_modal').modal('show');

							<?php }
               }   ?>
        @endif

  $(document).ready(function(){
     setTimeout(function() {
         $('#successMessageOffered').fadeOut('slow');
     }, 3000); // <-- time in milliseconds
 });


 /* =====> Rating Star <=========================== */
 jQuery(document).ready(function () {

     var $inp = $('#rating-input');

     $inp.rating({
         min: 0,
         max: 5,
         step: 1,
         size: 'lg',
         showClear: false
     });

     $inp.on('rating.change', function () {
         alert($('#rating-input').val());
     });
 });
 /* =====> Rating Star <=========================== */



</script>

@endsection


