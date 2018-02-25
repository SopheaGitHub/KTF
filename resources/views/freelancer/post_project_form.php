@extends('layouts.k_app')


@section('content')
<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="home.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to home page"></i></a></li>
		  	<li><a href="home.php">Home</a></li>
		  	<li class="active">Post a Project</li>
		</ol>
	</div>
	<div class="panel-body">
		<em><b>Tell us what you need done</b></em>
	    <br /><hr />
	    <div class="row">
	    	<div class="col-md-6">
	    		<form class="form-horizontal">

	    			<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Enter a name for your project</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  placeholder="e.g. Design a logo for me" autofocus />
				    </div>
				  	</div>

				  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Description about your project</label>
				    <div class="col-sm-8">
				    	<textarea class="form-control"  placeholder="Your text here ..." style="min-height:150px;max-height:150px;min-width:100%;max-width:100%;"></textarea>
				    </div>
				  	</div>

				  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">Upload file</label>
				    <div class="col-sm-8">
				      	<input type="file" class="form-control" />
				    </div>
				  	</div>

				  	<div class="form-group">
		              	<label for="input-skill" class="col-sm-4 control-label"><span data-toggle="tooltip" title="">What skills are required?</span></label>
		              	<div class="col-sm-8">
					      	<input type="text" name="skill" value="" placeholder="What skills are required?" id="input-skill" class="form-control" autocomplete="off" /><ul class="dropdown-menu"></ul>
			              	<div id="post-skill" class="well well-sm" style="height: 80px; overflow: auto;">
			                </div>
					    </div>
		            </div>

				  	<div class="form-group">
				    <label for="" class="col-sm-4 control-label">What is your estimated budget?</label>
				    <div class="col-sm-8">
				      <div class="row">
				      	<div class="col-md-3">
				      		<select class="form-control" id="currency">
				      			<option value="USD">USD</option>
				      			<option value="KHR">KHR</option>
				      		</select>
				      	</div>
				      	<div class="col-md-9">
				      		<select class="form-control" id="curency_range">
				      			<option value="1">5 - 10</option>
				      			<option value="2">10 - 50</option>
				      			<option value="3">50 - 100</option>
				      		</select>
				      	</div>
				      </div>
				    </div>
				  	</div>

				  	<div class="form-group">
				    <div class="col-sm-offset-4 col-sm-8">
				      <button type="submit" class="btn btn-success">Post My Project</button>
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


@endsection


<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change', '#currency', function(e) {
			e.preventDefault();

			var currency = $(this).val();
			var url = 'component/currency_range_'+currency.toLowerCase()+'.php';

		    $.ajax({
		        type: "GET",
		        url: url,
		        data: {"currency":currency},
		        cache: false,
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

		// skill
		$('input[name=\'skill\']').autocomplete({
		  'source': function(request, response) {
		    $.ajax({
		      	url: 'component/skill_array.php?filter_name=' +  encodeURIComponent(request),
		      	dataType: 'json',
		      	success: function(json) {
			        response($.map(json, function(item) {
			          return {
			            label: item['name'],
			            value: item['skill_id']
			          }
			        }));
		      	}
		    });
		  },
		  'select': function(event, ui) {
		    $('input[name=\'skill\']').val('');
		    $('#post-skill' + ui.item.value).remove();
		    $('#post-skill').append('<div id="post-skill' + ui.item.value + '"><i class="fa fa-minus-circle"></i> ' + ui.item.label + '<input type="hidden" name="post_skill[]" value="' + ui.item.value + '" /></div>');
		  }
		});

		$('#post-skill').delegate('.fa-minus-circle', 'click', function() {
		  $(this).parent().remove();
		});

	});
</script>

