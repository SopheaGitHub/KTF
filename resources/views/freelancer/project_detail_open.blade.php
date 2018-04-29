@extends('layouts.app')

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

    }

    ?>

<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="search_project.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to page search project"></i></a></li>
		  	<li><a href="home.php">Home</a></li>
		  	<li class="active">Project's Detail</li>
		</ol>
	</div>
    <?php
         foreach ($data->data_project_detail as $key => $items) { ?>
	<div class="panel-body">
	    <div class="row">
	    	<div class="col-md-8">
	    		<div class="row">
	    			<div class="col-md-8">
	    				<strong> <?php echo $items->name; ?> </strong>
	    			</div>
	    			<div class="col-md-2">
	    				Project ID: # <?php echo$items->id; ?>
	    			</div>
	    			<div class="col-md-2 text-center">
	    				<div class="alert alert-xs alert-info" role="alert"><strong>Open</strong></div>
	    			</div>
	    		</div>
	    		<hr />
	    		<h5>Description</h5>
	    		<p class="box-text">
	    			<?php echo $items->desc; ?>
	    		</p>
	    		<br />
	    		<h5>Files Attached</h5>
	    		<table class="">
	    			<tbody>
	    				<!--<tr>
	    					<td><a href="#"><i class="fa fa-file"></i> <span style="font-size:12px;">document.pdf</span></a></td>
	    				</tr>-->
	    				<tr>
	    					<td><a href="#"><i class="fa fa-image"></i> <span style="font-size:12px;"><?php echo $items->file_name; ?></span></a></td>
	    				</tr>
	    				<tr>
	    					<td>&nbsp;</td>
	    				</tr>
	    			</tbody>
	    		</table>
	    		<h5>Required Skills</h5>
	    		<div>
                    <?php
						if(isset($items->project_skill)){
                    $arr = explode(",",$items->project_skill);
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

                    <img class="media-object img-thumbnail" src="<?php echo url($items->profile); ?>" style="width:50px;" alt="name">
                  </div>
                  <div class="media-body">
                    <div>
                       <?php echo $items->username; ?>
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
						<span><a href="#">Chat</a></span> | <span><a href="{{ url($data->url_profile.'/'.$items->user_id) }}">View Profile</a></span></p>
                    </div>
                  </div>
                </div>
                <br /><br />
	    		<p><strong>Posted:</strong> <?php echo humanTiming(strtotime($items->created_at)); ?> ago</p>
	    		<p><strong>Project Budget :</strong>

                <?php if($items->currency==2){ ?>
				<?php echo $items->min.'KHR - '.$items->max.'KHR'; ?>
                <?php }else{ ?>
				 <?php echo '$'.$items->min.' - $'.$items->max; ?>
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
                $average = array_sum($items) / count($items);
                ?>
				<p><strong>Avg Bid:</strong> $<?php echo round($average,2); ?></p>
	    		<p><strong>Biding:</strong> <?php echo count($data->data_list_bid_project); ?></p>
	    		<hr />
	    		<div>
	    			<span><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Bid On This Project Now</a></span>
			   		<button class="btn btn-sm btn-success">Close This Project</button>
			   	</div>
	    	</div>
	    </div>
	</div>
</div>

<?php } ?>

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
			$average = array_sum($items) / count($items);
			?>


			<h5><?php echo count($data->data_list_bid_project); ?> freelancers are bidding on this project for average amount : $ <?php echo round($average,2);  ?></h5>
		</div>
		<div class="panel-body">

            <?php
            foreach ($data->data_list_bid_project as $key => $items) { ?>

		    <div class="media">
			  	<div class="media-left media-top">
			    	<a href="#">
			      		<img class="media-object img-thumbnail" src="<?php echo url($items->profile); ?>" style="width:70px;" style="width:70px;" alt="name">
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
								<span><a href="#">Chat</a></span> | <span><a href="{{ url($data->url_profile.'/'.$items->user_id) }}">View Profile</a></span></p>
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
						   		<button class="btn btn-sm btn-success" data-toggle="modal" data-target="<?php echo '#'.$items->user_id; ?>">Offer This Project</button>
						   	</div>
				    	</div>
				   	</div>
			  	</div>
			</div>
			<br />

			<?php } ?>




		</div>
	</div>
</div>

<!-- Modal Bid Project-->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				      		<input type="number" name="timeframe_value" id="timeframe-value" class="form-control" min="0" placeholder="Number of project timeframe" />
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
				      		<input type="number" name="amount" id="budget" class="form-control" min="0" placeholder="Amount will charge on project" />
				      	</div>
				    </div>
			    </div>
		  	</div>

		  	<div class="form-group">
		    <label for="" class="col-sm-3 control-label">Tell project owner about your related skill or what you will do on this project</label>
		    <div class="col-sm-9">
		      <textarea class="form-control" name="desc" id="desc" placeholder="Description here ..." style="min-height:200px;max-height:200px;min-width:100%;max-width:100%;"></textarea>
		    </div>
		  	</div>

		  	<div class="form-group">
		    <label for="" class="col-sm-3 control-label">Give your contact to project owner</label>
		    <div class="col-sm-9">
		      <input type="email"  name="contact" class="form-control"  placeholder="Your Phone Number Or Email" autofocus />
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
		      		<img class="media-object img-thumbnail" src="<?php echo url($items->profile); ?>" style="width:70px;" style="width:70px;" alt="name">
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
      			<button type="button" class="btn btn-success">Offer Project</button>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>

	<?php } ?>


<script type="text/javascript">
    {{--function submitBidForm(){--}}
        {{--var timeframe_value = $('#timeframe-value').val();--}}
        {{--var budget = $('#budget').val();--}}
        {{--var desc = $('#desc').val();--}}
        {{--alert(timeframe_value+' '+budget+' '+desc);--}}
		{{--$.ajax({--}}
                {{--type:'POST',--}}
			    {{--url:"<?php echo url('freelancer/bid_project/store'); ?>"+'?timeframe='+timeframe_value+'&budget='+budget+'&desc='+desc,--}}
                {{--data:{"timeframe_value":timeframe_value,"budget":budget,"desc":budget},--}}
			{{--beforeSend: function () {--}}
                    {{--$('#bidSubmitButton').attr("disabled","disabled");--}}
                    {{--$('.modal-body').css('opacity', '.5');--}}
                {{--},--}}
                {{--success:function(msg){--}}
                    {{--alert('sucess');--}}
                {{--}--}}
            {{--});--}}

    {{--}--}}
</script>

@endsection
