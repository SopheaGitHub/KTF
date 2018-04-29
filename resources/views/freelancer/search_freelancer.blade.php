@extends('layouts.k_app')

@section('content')

    <?php

	function splitStringFirst($str){
        $matches = preg_split('/\,/', $str);
        $first = isset($matches[0]) ? $matches[0] : '';
        $second = isset($matches[1]) ?  $matches[1] : '';
        return $first;
	}

    function splitStringSecond($str){
        $matches = preg_split('/\,/', $str);
        $first = isset($matches[0]) ? $matches[0] : '';
        $second = isset($matches[1]) ? $matches[1] : '';
        return $second;
    }
    function splitStringRemove($str){
        $matches = preg_split('/\,/', $str);
        $first = isset($matches[0]) ? $matches[0] : '';
        $second = isset($matches[1]) ? $matches[1] : '';
        return $first.$second;
    }

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

	<form   method="GET"  action="<?php echo $data->url_search; ?>">
	<div style="border: 1px solid #D5D5D5; background:#fff; padding:15px; border-radius: 4px 4px 0px 0px; padding-bottom: 0px;">
			<div class="form-group">

				<div class="input-group">
					<input id="txt_search" type="text" name="txt_search" class="form-control search" placeholder="&#xF002; Enter keyword ..."  value="<?php
                    if(isset($data->data_input_search)){
                        echo $data->data_input_search;
                    }
                    ?>"/>
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"> Search</button>
					</div>
				</div>

		  	</div>
	</div>

        <?php if(isset($data->data_budget_selected))  { ?>
		<input type="hidden" value="<?php echo splitStringRemove($data->data_budget_selected); ?>" id="budget_id"/>
        <?php } ?>
	<div style="background:#fff; padding:15px;">
		<div class="row">
			<div class="col-md-4" style="margin-bottom:5px;">
			  	  <select class="form-control" id="curency_range" name="curency_range" onchange="this.form.submit()">
					<option value="">-- Budget --</option>
                    <?php foreach ($data->data_budget_range as $key => $value) {  ?>
					 <option id="<?php echo splitStringRemove($value->budget_range_id); ?>" value="<?php echo $value->budget_range_id; ?>">  <?php echo '$'.splitStringFirst($value->min) .'- $'. splitStringFirst($value->max). ' | '.splitStringSecond($value->min) .'R - '.splitStringSecond($value->max).'R'; ?>
				     </option>
                  <?php
						}
                    ?>
				</select>
			</div>
		</div>
		<hr />

	</div>
	</form>

	<div style="background:#fff; padding:15px; min-height: 300px;">
	<div class="row">

        <?php
        foreach ($data->data_freelancer_list as $key => $items) { ?>

		<div class="col-md-6">
			<div class="media" style="padding:10px; background: #f5f8fa; border-radius:4px; margin-bottom:15px;">
				<div class="media-left media-top">
					<a href="{{ url($data->url_profile.'/'.$items->user_id) }}">
						<img class="media-object img-thumbnail" src="<?php echo url($items->profile); ?>" style="width:70px;" style="width:70px;" alt="name">
					</a>
				</div>
				<div class="media-body">
					<div>
						<strong> <?php echo $items->username; ?></strong>
					</div>
					<div>
                        <?php
                        $arr = explode(",",$items->user_skill);
                        foreach ($arr as $item) { ?>
						<a href="#" class="btn btn-xs btn-default"><?php echo preg_split('/\--/', $item)[1] ?></a>
                        <?php }  ?>
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



    <div class="row">
        <div class="col-sm-8 text-left" id="render-post"><?php echo $data->data_freelancer_list->render(); ?></div>
        <div class="col-sm-4 text-right">
            <?php
            $start = ($data->data_freelancer_list->currentPage() * $data->data_freelancer_list->perPage()) - $data->data_freelancer_list->perPage() + 1;
            $stop = $data->data_freelancer_list->currentPage() * $data->data_freelancer_list->perPage();
            if($stop > $data->data_freelancer_list->total()){
                $stop = ( $start + $data->data_freelancer_list->count()) - 1;
            }
            if($stop == 0){
                $start = 0;
            }
            ?>
            Show <?php echo $start; ?> To <?php echo $stop; ?> Of <?php echo $data->data_freelancer_list->total(); ?> &nbsp;&nbsp; (Page <?php echo $data->data_freelancer_list->currentPage(); ?>)
        </div>
    </div>




	<br />

	<script>
        $(document).ready(
            function(){
                var stataus_value = $('#status_id').val();
                $("#status option[value="+stataus_value+"]").attr('selected',true);
                var budget_id_value = $('#budget_id').val();
                var str = budget_id_value.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
                $("#"+str+"").prop('selected',true);
            });
	</script>
@endsection
