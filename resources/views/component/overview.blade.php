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

}

?>

<h4>Profolio</h4>
<br />

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-4">
  	<div class="thumbnail box-showcase" style="overflow:hidden;">
  		<span class="komalhover dhiraj">
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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
	    	<img class="boximg" width="100%" height="auto" src="http://i.imgur.com/DvpvklR.png" style="top: 0px" alt="61f9b2.jpg" />
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

<br />






<div class="row">
	<div class="col-md-9">
		<h4>Recent Reviews</h4>
		<br />



        <?php
        foreach ($data->data_review_list as $key => $items) { ?>


		<div class="media">
		  	<div class="media-left media-top">
		    	<a href="<?php echo $data->url_profile; ?>/<?php echo $items->rate_from;  ?>">
		      		<img class="media-object img-thumbnail" src="<?php echo url('/').'/'.$items->profile; ?>" style="width:70px;" style="width:70px;" alt="name">
		    	</a>
		  	</div>
			<div class="media-body">
			    <h4 class="media-heading"><a href="<?php echo $data->url_profile; ?>/<?php echo $items->rate_from;  ?>"><?php echo $items->username; ?></a></h4>
			    <div>
			    	<span style="padding: 3px; background:#5cb85c; color:#fff;">5.0</span>&nbsp;
			    	<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
			    	<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
			    	<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
			    	<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>&nbsp;
			    	<i class="fa fa-star" aria-hidden="true" style="color:#5cb85c;"></i>
			    	&nbsp;&nbsp;| &nbsp;
					<?php if($items->currency==2){ ?>
					<span><?php echo $items->min.'KHR - '.$items->max.'KHR'; ?> </span>
                    <?php }else{ ?>
					<span><?php echo '$'.$items->min.' - $'.$items->max; ?></span>
                    <?php } ?>

			    	&nbsp;&nbsp;| &nbsp;&nbsp;<span><?php echo humanTiming(strtotime($items->created_at)); ?> ago</span>
			   	</div>
			   	<br />
			   	<p>
                    <?php
                    $arr = explode(",",$items->user_skill);
                    foreach ($arr as $item) { ?>
					<button type="button" class="btn btn-xs btn-default"><?php echo preg_split('/\--/', $item)[1] ?></button>
                    <?php }  ?>
				</p>
			   	<br />
			    <p>
			    	“<?php echo $items->desc; ?>”
			  	</p>
			</div>
		</div>
		<hr />


		<?php }  ?>





	<!--	<nav aria-label="Page navigation" class="text-right">
		  <ul class="pagination" style="margin:0px;">
		    <li>
		      <a href="#" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <li class="active"><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li>
		      <a href="#" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>  -->


		<div class="row">
			<div class="col-sm-8 text-left" id="render-post"><?php echo $data->data_review_list->render(); ?></div>
			<div class="col-sm-4 text-right">
                <?php
                $start = ($data->data_review_list->currentPage() * $data->data_review_list->perPage()) - $data->data_review_list->perPage() + 1;
                $stop = $data->data_review_list->currentPage() * $data->data_review_list->perPage();
                if($stop > $data->data_review_list->total()){
                    $stop = ( $start + $data->data_review_list->count()) - 1;
                }
                if($stop == 0){
                    $start = 0;
                }
                ?>
				Show <?php echo $start; ?> To <?php echo $stop; ?> Of <?php echo $data->data_review_list->total(); ?> &nbsp;&nbsp; (Page <?php echo $data->data_review_list->currentPage(); ?>)
			</div>
		</div>



	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading"><h5>Skill</h5></div>
		  <div class="panel-body">
		  	Photoshop
		    <div class="progress">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			    60%
			  </div>
			</div>
			Illustrator
			<div class="progress">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
			    40%
			  </div>
			</div>

			Mobile APP
			<div class="progress">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">
			    95%
			  </div>
			</div>

		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h5>Browse Similar Skill</h5></div>
		  <div class="panel-body">
              <?php
              foreach ($data->list_skill as $key => $item) {  ?>
                  <button type="button" class="btn btn-default btn-xs"><?php  echo $item->skill_title; ?></button>
              <?php
              		}
              ?>
		    	<button type="button" class="btn btn-default btn-xs">Graphic Design</button>

		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h5>Browse Similar Show Cases</h5></div>
		  <div class="panel-body">
		    	<button type="button" class="btn btn-default btn-xs">Graphic Design</button>
			  	<button type="button" class="btn btn-default btn-xs">Logo</button>
			  	<button type="button" class="btn btn-default btn-xs">Design</button>
			  	<button type="button" class="btn btn-default btn-xs">Logo Design</button>
		  </div>
		</div>
	</div>
</div>