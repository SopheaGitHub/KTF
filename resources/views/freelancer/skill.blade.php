
@extends('layouts.k_app')

 @section('content') 

<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="profile.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to profile"></i></a></li>
		  	<li><a href="home.php">Home</a></li>
		  	<li><a href="profile.php">Profile</a></li>
		  	<li class="active">Skill</li>
		</ol>
	</div>
	<div class="panel-body">
		<div><em>Please tell us, what skill do you can?</em></div>
	    <hr />

	    <form class="form-horizontal">
			<div class="row">
				<div class="col-md-4">

					<div class="form-group">
					    <label for="" class="col-sm-3 control-label">Select Skill</label>
					    <div class="col-sm-9">
					      	<div class="row">
					      		<div class="col-md-4">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal1"><i style="font-size:30px;" class="zmdi zmdi-palette"></i><br />Art</div>
					      		</div>
					      		<div class="col-md-4">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal2"><i style="font-size:30px;" class="zmdi zmdi-desktop-windows"></i><br />Design</div>
					      		</div>
					      		<div class="col-md-4">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal3">
					      				<i style="font-size:30px;" class="zmdi zmdi-camera"></i><br />Photography</div>
					      		</div>
					      		<div class="col-md-4">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal4">
					      				<i style="font-size:30px;" class="zmdi zmdi-laptop-chromebook"></i><br />Web Develop</div>
					      		</div>
					      		<div class="col-md-4">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal5">
					      				<i style="font-size:30px;" class="zmdi zmdi-code-smartphone"></i><br />Mobile App</div>
					      		</div>
					      	</div>
					    </div>
				  	</div>

					<div class="form-group">
					    <label for="" class="col-sm-3 control-label">Available</label>
					    <div class="col-sm-9">
					    	<select name="available" class="form-control">
					    		<option value="1">Part Time</option>
					    		<option value="2">Full Time</option>
					    	</select>
					    </div>
				  	</div>

				  	<div class="form-group">
					    <label for="" class="col-sm-3 control-label">Bubget</label>
					    <div class="col-sm-9">
					      	<div class="row">
						      	<div class="col-md-4">
						      		<select class="form-control" id="currency">
						      			<option value="USD">USD</option>
						      			<option value="KHR">KHR</option>
						      		</select>
						      	</div>
						      	<div class="col-md-8">
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
					    <div class="col-sm-offset-3 col-sm-9">
					      	<a href="#" class="btn btn-default">Skip</a>
							<button class="btn btn-success">Continue</button>
					    </div>
				  	</div>
				</div>
			</div>

		  	
		</form>

	</div>
</div>


<!-- Modal1 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-palette"></i> Art</h4>
      </div>
      <div class="modal-body">
        <div class="checkbox">
		    <label>
		      <input type="checkbox"> Collage
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Digital Art
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Drawing
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Metal
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Mosaic
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Painting
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Sculpture
		    </label>
		</div>
      </div>
      <div class="modal-footer">
		<button class="btn btn-success">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-desktop-windows"></i> Design</h4>
      </div>
      <div class="modal-body">
      	<div class="checkbox">
		    <label>
		      <input type="checkbox"> Adnimation
		    </label>
		</div>
        <div class="checkbox">
		    <label>
		      <input type="checkbox"> Printmaking
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Advertising
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Illustrator
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Interior
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Exterior
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Template
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Book
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Magazine
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Clothing
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Merchandise
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Glass
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Wood
		    </label>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal3 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-camera"></i> Photography</h4>
      </div>
      <div class="modal-body">
        <div class="checkbox">
		    <label>
		      <input type="checkbox"> Abstract
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Advertising
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Animals
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Architecture
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Black & White
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Editorial
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Fashion
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Feminist
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Figurative
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Floral
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Food
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Genre
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Landscape
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Marine
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Narrative
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Nature
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Night
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Nude
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> People
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Photojournalism
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Portrait
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Real Estate
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Satire
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Seascape
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Sports
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Still Life
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Street
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Travel
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Urban
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Wedding & Event
		    </label>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal4 -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-laptop-chromebook"></i> Web Develop</h4>
      </div>
      <div class="modal-body">
      	<h5 style="margin:10px 0px; color:#cccccc;">Web Design</h5>
        <div class="checkbox">
		    <label>
		      <input type="checkbox"> HTML
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> CSS
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Bootstrap
		    </label>
		</div>
		<h5 style="margin:10px 0px; color:#cccccc;">Javascript</h5>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Javascript
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Jquery
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> AngularJS
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Json
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Ajax
		    </label>
		</div>
		<h5 style="margin:10px 0px; color:#cccccc;">Server Side</h5>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> MySql
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> PostgresSQL
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Oracel
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> PHP
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> PHP Freamwork
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> Note.js
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> ASP.Net
		    </label>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal5 -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-code-smartphone"></i> Mobile App</h4>
      </div>
      <div class="modal-body">
        <div class="checkbox">
		    <label>
		      <input type="checkbox"> Android App Deveopment
		    </label>
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox"> IOS App Deveopment
		    </label>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Done</button>
      </div>
    </div>
  </div>
</div>


 <!-- @include('component.footer_') -->

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
	});
</script>
 @endsection 
