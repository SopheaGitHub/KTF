@extends('layouts.k_app')



@section('content')
<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="home.blade.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to home page"></i></a></li>
		  	<li><a href="home.blade.php">Home</a></li>
		  	<li class="active">Post a Project</li>
		</ol>
	</div>
	<div class="panel-body">
		<em><b>Tell us what you need done</b></em>
	    <br /><hr />
	    <div class="row">
	    	<div class="col-md-6">
	   <form class="form-horizontal"  method="POST"  action="<?php echo $data->url_store; ?>" enctype="multipart/form-data" >

					<input type="hidden" name="_token" value="{{ csrf_token() }}" >
	    			
				    <div class="form-group{{ $errors->has('txt_project_name') ? ' has-error' : '' }}">
				    	 <label for="" class="col-sm-4 control-label"><?php echo trans('project.enter_project_name_label') ?></label>
                       
                            <div class="col-md-8">
                                <input id="txt_project_name" type="text" class="form-control" name="txt_project_name" value="{{ old('txt_project_name') }}"   placeholder="e.g. Design a logo for me" autofocus>

                                @if ($errors->has('txt_project_name'))
                                    <span hidden class="help-block">
                                        <strong>{{ $errors->first('txt_project_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>

		            <div class="form-group{{ $errors->has('txt_project_desc') ? ' has-error' : '' }}">
						   <label for="" class="col-sm-4 control-label"><?php echo trans('project.description_about_your_project'); ?></label>
						   <div class="col-sm-8">
							   <textarea class="form-control" id="txt_project_desc" name="txt_project_desc" placeholder="<?php echo trans('project.your_text_here') ?>" style="min-height:150px;max-height:150px;min-width:100%;max-width:100%;"><?php echo old('txt_project_desc'); ?></textarea>
							   @if ($errors->has('txt_project_desc'))
								   <span class="help-block">
												<strong>{{ $errors->first('txt_project_desc') }}</strong>
											</span>
							   @endif
						   </div>
					   </div>

				  	 <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				    	 <label for="" class="col-sm-4 control-label"><?php echo trans('project.upload_file')  ?></label>
                            <div class="col-md-8">
                            <input type="file" name="image" id="image"  class="form-control" value="{{ old('image') }}" placeholder="Image"/>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>

				  	<div class="form-group">
		              	<label for="input-skill" class="col-sm-4 control-label"><span data-toggle="tooltip" title=""><?php echo trans('project.what_skill_are_required'); ?></span></label>
		              	<div class="col-sm-8">



					     <input type="text" name="skill" id="input-skill" value="" placeholder="<?php echo trans('project.what_skill_are_required'); ?>" id="input-skill" class="form-control" />


					      <ul class="dropdown-menu"></ul>

			              	<div id="post-skill" class="well well-sm" style="height: auto;  width:100%; min-height: 120px;">
                                <?php
									if(count(old('post_skill')) > 0) {
									    $skill_arr = $data->data_skill;
									    foreach (old('post_skill') as $key => $value) { ?>
											<div id="post-skill<?php echo $value; ?>">
												<i class="fa fa-minus-circle"></i>
											<?php	foreach( $skill_arr as $item) {
											    if($item->skill_id==$value){
                                                    echo $item->skill_title;
												}
											}?>
									<input type="hidden" name="post_skill[]" value="<?php echo $value; ?>" /></div>
									 <?php   }
									}
								?>
			                </div>
					    </div>
		            </div>
				  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label"><?php echo trans('project.what_is_your_estimated_budget'); ?></label>
				    <div class="col-sm-8">
				      <div class="row">
				      	<div class="col-md-3">
				      		<select class="form-control" id="currency" name="currency[]">
							      			<?php
								    	         foreach ($data->data_currency as $key => $value) { ?>
							      			<option value="<?php echo $value->currency_id; ?>"><?php echo $value->currency_name; ?></option>
							      			<?php } ?>
							       </select>
				      	</div>
				      	<div class="col-md-9">
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
				    <div class="col-sm-offset-4 col-sm-8">
				      <button type="submit" class="btn btn-success"><?php echo trans('project.post_my_project'); ?></button>
				    </div>
				  	</div>
				</form>


	    	</div>
	    </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Privacy title</h4>
      </div>
      <div class="modal-body">
        your text here
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
	$(document).ready(function() {

	$('input[name=\'skill\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo $data->go_skill_autocomplete;?>?filter_name='+  encodeURIComponent($('#input-skill').val()),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['skill_title'],
            value: '',
            dataid: item['skill_id']
          }
        }));
      }
    });
  },
  'select': function(event , ui) {
    $('input[name=\'skill\']').val('');

    $('#post-skill' + ui.item.dataid).remove();

    $('#post-skill').append('<div id="post-skill' + ui.item.dataid + '"><i class="fa fa-minus-circle"></i> ' + ui.item.label + '<input type="hidden" name="post_skill[]" value="' + ui.item.dataid + '" /></div>');
  }
});

$('#post-skill').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
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

			$('.btn-done').click(function() {
				alert($('.btn-done').attr('data-id'));
				//$('div[id='+id+']').hide();
			});


});

</script>



@endsection

