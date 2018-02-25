
@include('component.header')

<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="home.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to home page"></i></a></li>
		  	<li><a href="home.php">Home</a></li>
		  	<li class="active">Join Us</li>
		</ol>
	</div>
	<div class="panel-body">
		<em>Join us now ... it's for free.</em>
	    <br /><hr />
	  	<div class="col-md-4">
	    		<form class="form-horizontal" method="post" action="<?php echo $data->url_store; ?>">
	    			<input type="hidden" name="_token" value="{{ csrf_token() }}" >

	    			<!-- <div class="form-group">
				    <label for="" class="col-sm-3 control-label">First Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control"  placeholder="First Name" autofocus  name="txtFirstName" />
				    </div>
				  	</div> -->


				  	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="txtFirstName" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>







				  	<div class="form-group">
				    <label for="" class="col-sm-3 control-label">Last Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control"  placeholder="Last Name"  name="txtLastName"/>
				    </div>
				  	</div>

				  	<div class="form-group">
				    <label for="" class="col-sm-3 control-label">Phone Number Or Email</label>
				    <div class="col-sm-9">
				      <input type="email" class="form-control"  placeholder="Phone Number Or Email" name="txtPhoneNoOrMail" />
				    </div>
				  	</div>

				  	<div class="form-group">
				    <label for="" class="col-sm-3 control-label">Password</label>
				    <div class="col-sm-9">
				      <input type="password" class="form-control" placeholder="Password"  name="txtPassword" id="txtNewPassword"/>
				    </div>
				  	</div>

				  	<div class="form-group">
				    <label for="" class="col-sm-3 control-label">Confirm Password</label>
				    <div class="col-sm-9">
				      <input type="password" class="form-control" placeholder="Confirm Password" id="txtConfirmPassword" onkeyup="checkPasswordMatch();"  />
				    </div>

				      <div class="col-sm-9" id="divCheckPasswordMatch" > </div>
				   
				  	</div>

				  	<div class="form-group">
	                    <div class="col-md-9 col-md-offset-3">
	                        <div class="checkbox">
	                            <label>
	                                <input type="checkbox" name="remember" /> <a href="#" data-toggle="modal" data-target="#myModal" required >Accept Policy</a>
	                            </label>
	                        </div>
	                    </div>
	                </div>

				  	<div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <button type="submit" class="btn btn-success">Register</button>
				    </div>
				  	</div>
				</form>
	    	</div>
	    	<div class="col-md-4 text-right">
	    		Or Join Us With
	    		<div><a href="#" class="btn btn-primary" style="width:50%; margin:5px;"><i class="fa fa-facebook"></i>acebook</a></div>
	    		<div><a href="#" class="btn btn-danger" style="width:50%; margin:5px;"><i class="fa fa-google"></i>oogle</a></div>
	    		<br /><br />
	    	</div>
	    	<div class="col-md-4">
	    		Already have an account? <a href="login.php">Login</a>
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
@include('component.footer')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript"><!--
function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Passwords do not match!");
    else
        $("#divCheckPasswordMatch").html("Passwords match.");
}
//--></script>
