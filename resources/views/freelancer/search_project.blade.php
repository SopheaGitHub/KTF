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
			<div class="col-md-2" style="margin-bottom:5px;">
				<?php if(isset($data->data_status_selected)){ ?>
				<input type="hidden" value="<?php echo $data->data_status_selected; ?>" id="status_id"/>
					<?php } ?>
				<select class="form-control input-sm" id="status" name="status" onchange="this.form.submit()">
					<option value="">-- Status --</option>
                    <?php
                    foreach ($data->data_status as $key => $value) { ?>
					<option value="<?php echo $value->status_id; ?>"><?php echo $value->status_name; ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
		<hr />

	</div>
	</form>


	<div style="background:#fff; padding:15px; min-height: 300px;">
        <?php
        foreach ($data->data_project_list as $key => $items) { ?>

		<div class="media">
			<div class="media-left media-top">
				<a href="#">
					<img class="media-object img-thumbnail" src="<?php echo URL::to('/'.$items->profile); ?>" style="width:70px;" style="width:70px;" alt="name">
				</a>
			</div>
			<div class="media-body">

				<div class="row">
					<div class="col-md-9">
						<h4 class="media-heading"><a href="project_detail_open.php"><?php echo $items->name; ?></a></h4>
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
						<div>
							<?php
							if($items->status_id==1 ){ ?>
								<button class="btn btn-sm btn-success">Bid Now</button>
						   <?php }else if($items->status_id==2){ ?>
								<div class="alert alert-xs alert-warning" role="alert"><center><strong>Offered</strong></center></div>
							<?php }else if($items->status_id==3){  ?>
								<div class="alert alert-xs alert-danger" role="alert"><center><strong>Closed</strong></center></div>
							<?php	}
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr />

        <?php
        }
        ?>
	</div>

	<div class="row">
		<div class="col-sm-8 text-left" id="render-post"><?php echo $data->data_project_list->render(); ?></div>
		<div class="col-sm-4 text-right">
            <?php
            $start = ($data->data_project_list->currentPage() * $data->data_project_list->perPage()) - $data->data_project_list->perPage() + 1;
            $stop = $data->data_project_list->currentPage() * $data->data_project_list->perPage();
            if($stop > $data->data_project_list->total()){
                $stop = ( $start + $data->data_project_list->count()) - 1;
            }
            if($stop == 0){
                $start = 0;
            }
            ?>
			Show <?php echo $start; ?> To <?php echo $stop; ?> Of <?php echo $data->data_project_list->total(); ?> &nbsp;&nbsp; (Page <?php echo $data->data_project_list->currentPage(); ?>)
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
