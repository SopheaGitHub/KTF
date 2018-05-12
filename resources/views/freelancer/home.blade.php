@extends('layouts.k_app')

@section('css')
	<style>
		#label{
			color: #4f829c;
			background: transparent;
			border: 0px solid #FFFFFF;
		}
		#label:hover{
			text-decoration:underline;
		}
	</style>
@endsection

@section('content')
<!-- content -->

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

<div style="border: 1px solid #D5D5D5; background:#fff; min-height: 300px;">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="img/first-slide.svg" alt="First Slide" style="height:300px; width:100%;">
				<div class="carousel-caption">
					Hire Freelancers
				</div>
			</div>
			<div class="item">
				<img src="img/second-slide.svg" alt="Second Slide" style="height:300px; width:100%;">
				<div class="carousel-caption">
					Find Projects
				</div>
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<br />

<div style="border: 1px solid #D5D5D5; background:#fff; padding:15px; min-height: 300px;">
	<form  method="GET"  action="<?php echo $data->url_search; ?>">
		<div class="row">
			<div class="col-md-4">
				<span><h4>Available Projects</h4></span><span>

						<input type="hidden" name="status" value="1" />
					<button id="label"  type="submit" >See All Available</button>

				</span> |
				<span><a  id="label" href="<?php echo $data->url_project_search; ?>">See All Posted</a></span>

			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group">
						<input id="txt_search" type="text" name="txt_search" class="form-control search" placeholder="Find available projects?"/>
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"> Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<hr />


    <?php
    foreach ($data->data_project_list as $key => $items) { ?>

	<div class="media">
		<div class="media-left media-top">
			<a href="#">
				<img class="media-object img-thumbnail" src="<?php echo $items->profile; ?>" style="width:70px;" alt="name">
			</a>
		</div>
		<div class="media-body">

			<div class="row">
				<div class="col-md-9">
					<h4 class="media-heading"><a href="{{ url($data->url_project_detail_open.'/'.$items->id) }}"><?php echo $items->name; ?></a></h4>
					<p>
                        <?php echo $items->desc; ?>
					</p>
                    <?php
                    $p_skills = explode(',', $items->p_skill_id);
                    $skill_arr =	$data->data_skill_list;

                    foreach ($p_skills as $skill_id) {
                    foreach( $skill_arr as $item) {
                    if($item->skill_id==$skill_id){  ?>
					<a href="#"><?php echo $item->skill_title.' ';?></a>&nbsp;&nbsp;
                    <?php   }
                    }
                    }
                    ?>

				</div>
				<div class="col-md-3 text-right">
					<p><span> <?php echo humanTiming(strtotime($items->created_at)); ?> ago</span></p>
					<p><span><?php echo $items->min.$items->currency_symbol.' - '.$items->max.$items->currency_symbol ?></span> | <span>Bids 2</span></p>
					<div><button class="btn btn-sm btn-success">Bid Now</button></div>
				</div>
			</div>
		</div>
	</div>
	<hr />

    <?php
    }
    ?>

</div>
<br />

<div style="border: 1px solid #D5D5D5; background:#fff; padding:15px; min-height: 300px;">
	<form  method="GET"  action="<?php echo $data->url_search_freelancer; ?>">
		<div class="row">
			<div class="col-md-4">
				<span><h4>Freelancers</h4></span><span><a href="<?php echo $data->url_freelancer_search; ?>">See All</a></span>
			</div>
			<div class="col-md-8">
				<div class="input-group">
					<input id="txt_search" type="text" name="txt_search" class="form-control search" placeholder="Find talented freelancers?"/>
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"> Search</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<hr />
	<div class="row">



        <?php
        foreach ($data->data_freelancer_list as $key => $items) { ?>

		<div class="col-md-6">
			<div class="media" style="padding:10px; background: #f5f8fa; border-radius:4px; margin-bottom:15px;">
				<div class="media-left media-top">
					<a href="{{ url($data->url_profile.'/'.$items->user_id) }}">
						<img class="media-object img-thumbnail" src="<?php echo $items->profile; ?>" style="width:70px;" style="width:70px;" alt="name">
					</a>
				</div>
				<div class="media-body">
					<div>
						<strong>   <?php echo $items->username; ?></strong>
					</div>
					<div>
                        <?php
						  $arr = explode(",",$items->user_skill);
                           foreach ($arr as $item){
                           if(isset(preg_split('/\--/', $item)[1])){  ?>
							<a href="#" class="btn btn-xs btn-default"><?php  echo preg_split('/\--/', $item)[1];  ?></a>
							<?php }else{ ?>
							<span class="btn btn-xs btn-danger">No skill !!</span>
                            <?php } }   ?>
					</div>
					<div style="margin: 10px 0px;">
						<span style="padding: 3px; background:#5cb85c; color:#fff;">4.0</span>&nbsp;
						<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
						<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
						<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
						<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
						<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>
						&nbsp;&nbsp; <span>(5 Reviews)</span>
					</div>
					<?php if($items->currency==2){ ?>
					<p><strong>Budget: <?php echo $items->min.'KHR - '.$items->max.'KHR'; ?> </strong> | <span><a href="#">Chat</a></span> | <span><a href="{{ url($data->url_profile.'/'.$items->user_id) }}">View Profile</a></span></p>
				    <?php }else{ ?>
					<p><strong>Budget: <?php echo '$'.$items->min.' - $'.$items->max; ?></strong> | <span><a href="#">Chat</a></span> | <span><a href="{{ url($data->url_profile.'/'.$items->user_id) }}">View Profile</a></span></p>
					<?php } ?>
				</div>
			</div>
		</div>

            <?php
            }
            ?>
	</div>

</div>
<br />

<div style="border: 1px solid #D5D5D5; background:#fff; padding:15px; min-height: 300px;">
	<form>
		<div class="row">
			<div class="col-md-4">
				<span><h4>Showcase</h4></span><span><a href="#">See All</a></span>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Find the best showcase?">
						<div class="input-group-addon">Search</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<hr />
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/61f9b2.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Graphic Design </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text">
					    	<a href="#" class="btn btn-sm btn-success">View</a>
					    </div>
					</div>
			    </span>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/a87e69.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Logo Design </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text"><a href="#" class="btn btn-sm btn-success">View</a></div>
					</div>
			    </span>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/f0f2ae.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Logo Criative </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text"><a href="#" class="btn btn-sm btn-success">View</a></div>
					</div>
			    </span>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/f0f2ae.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Best Design </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text"><a href="#" class="btn btn-sm btn-success">View</a></div>
					</div>
			    </span>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/f8e626.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Wonderfull Logo </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text"><a href="#" class="btn btn-sm btn-success">View</a></div>
					</div>
			    </span>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="thumbnail box-showcase" style="overflow:hidden;">
		  		<span class="komalhover dhiraj">
			    	<img class="boximg" width="100%" height="auto" src="img/a87e69.jpg" style="top: 0px" alt="61f9b2.jpg" />
			    	<div class="boxtitle">
			    		<a href="#"> Simple Logo Design </a>
			    	</div>
			    	<div class="overlay">
					    <div class="text"><a href="#" class="btn btn-sm btn-success">View</a></div>
					</div>
			    </span>
			</div>
		</div>

	</div>

</div>
<br />

@endsection