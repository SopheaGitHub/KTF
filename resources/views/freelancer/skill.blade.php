
	@extends('layouts.k_app')

	@section('content') 

	<div class="panel panel-success">
		<div class="panel-heading">
			<ol class="breadcrumb">
				<li><a href="profile.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to profile"></i></a></li>
			  	<li><a href="home.blade.php">Home</a></li>
			  	<li><a href="profile.php">Profile</a></li>
			  	<li class="active">Skill</li>
			</ol>
		</div>
		<div class="panel-body">
			<div><em>Please tell us, what skill do you can?</em></div>
		    <hr />

		    <form class="form-horizontal" method="post" action="<?php echo $data->url_store; ?>" >
		    	
		    	<div class="add-skill"  type="hidden">

		    	</div>

		    	<input type="hidden" name="_token" value="{{ csrf_token() }}" >
				<div class="row">
					<div class="col-md-4">

						
							<div class="form-group{{ $errors->has('checkbox_skill') ? ' has-error' : '' }}">
						    <label for="" class="col-sm-3 control-label">Select Skill</label>
						    <div class="col-sm-9">
						      	<div class="row">
								<?php
								    foreach ($data->main_categories as $key => $value) { ?>
								      <div class="col-md-4">
						      			<div class="category-box category-box<?php echo $value->skill_id ?>" data-toggle="modal" data-target="<?php echo '#'.$value->skill_id; ?>" data-value="<?php echo $value->skill_title; ?>">
						      				<i style="font-size:30px;" class="zmdi zmdi-camera"></i><br /><?php echo $value->skill_title; ?></div>
						          	</div>
						          	 <?php	
						          	    }
								    ?>
						      	</div>
						        @if ($errors->has('checkbox_skill'))
							        <span class="help-block">
	                                        <strong> {{ $errors->first('checkbox_skill') }}</strong>
	                                </span>
	                             @endif    	

						    </div>
					  	</div>
					  
						<div class="form-group">
						    <label for="" class="col-sm-3 control-label">Available</label>
						    <div class="col-sm-9">
						    	<select name="available" class="form-control" name="available[]">
						    		<option value="Part Time">Part Time</option>
						    		<option value="Full Time">Full Time</option>
						    	</select>
						    </div>
					  	</div>

					  	<div class="form-group">
						    <label for="" class="col-sm-3 control-label">Bubget</label>
						    <div class="col-sm-9">
						      	<div class="row">

							    <div class="col-md-4">
							      	<select class="form-control" id="currency" name="currency[]">
							      			<?php
								    	         foreach ($data->data_currency as $key => $value) { ?>
							      			<option value="<?php echo $value->currency_id; ?>"><?php echo $value->currency_name; ?></option>
							      			<?php } ?>
							       </select>
							     </div>

							      	<div class="col-md-8">
							      		<select class="form-control" id="curency_range" name="curency_range">

							      			<?php
								    	      foreach ($data->data_budget_range as $key => $value) { 
								      		 if($value->currency_id==1){ 
		?>
	     <option value="<?php echo $value->budget_range_id; ?>">  <?php echo  '$'.$value->min .'- $'. $value->max; ?>
	</option>
	<?php  }else{    ?>
				<option value="<?php echo $value->budget_range_id; ?>">  <?php echo $value->min .'R -'. $value->max.'R'; ?>
	</option>
		?>  
							      			
							      			<?php 
							      			}  
							      				 }  
							      		    ?>
							      		</select>
							      	</div>
							    </div>
						    </div>
					  	</div>

					  	<div class="form-group">
						    <div class="col-sm-offset-3 col-sm-9">
						      	<a href="#" class="btn btn-default">Skip</a>
								<button  type="submit"  class="btn btn-success">Continue</button>
						    </div>
					  	</div>
					</div>
				</div>		
	


	<!-- Modal skill -->

	<?php
		 foreach ($data->main_categories as $key => $item) { ?>
	<div class="modal fade" id="<?php echo $item->skill_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-camera"></i> {{ $item->skill_title}} </h4>
	      </div>
	      <div class="modal-body">
	        <div class="checkbox"> 
	        	<?php 
	        	$skill_title = $item->skill_title;  
	            foreach ($data->$skill_title as $key => $value) {
	          ?>
	        	  
			    <label>
			      <input type="checkbox" id="checkbox_skill" name="checkbox_skill[]" class="skill<?php echo $item->skill_id; ?>" value="<?php  echo $value->skill_id; ?>"> <?php  echo $value->skill_title; ?>
			    </label>
			     <?php  }  ?>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-success btn-done" data-id="{{ $item->skill_id}}" data-dismiss="modal">Done</button>
	      </div>
	    </div>
	  </div>
	</div>
	<?php  }  ?>


	</form>

</div>
</div>

	<script type="text/javascript">
			$(document).on('change', '#currency', function(e) {
				e.preventDefault();
				var currency = $(this).val();
				var url = '/currency_range?currency_id='+currency;
			    $.ajax({
			        type: "GET",
			        url: url,
			        beforeSend: function () {
			        	// before send
			        },
			        complete: function () {
			          	// completed
			        },
			        success: function (html) {
			          $('#curency_range').html(html).show();
			        },
			        error: function (request, status, error) {
			            var msg = '';
			            msg += '<div class="alert alert-warning" id="warning">';
			            msg += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			                msg += '<b><i class="fa fa-info-circle"></i> '+error+' </b><br />';
			            msg += '</div>';
			            $('#curency_range').html(msg).show();
			        }
			    });
			});

			<?php
				foreach ($data->main_categories as $key => $item) { ?>
					
					$('#'+<?php echo $item->skill_id; ?>).on('hidden.bs.modal', function (e) {
					  	if( $('.skill'+<?php echo $item->skill_id; ?>).is(":checked") ) {
					  		$('.category-box'+<?php echo $item->skill_id; ?>).addClass( "active_category-box" );
					  	}else {
					  		$('.category-box'+<?php echo $item->skill_id; ?>).removeClass( "active_category-box" );
					  	}
					});
			<?php	}
			?>

	</script>
	 @endsection 
