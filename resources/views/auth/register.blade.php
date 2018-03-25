@extends('layouts.k_app')

@section('content')
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
	    <div class="row">
	    	<div class="col-md-4">
	    		<form class="form-horizontal" method="post" action="<?php echo route('register'); ?>">

	    			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>" >

	    			<div class="form-group<?php echo $errors->has('user_firstname') ? ' has-error' : ''; ?>">
					    <label for="" class="col-sm-5 control-label"><?php echo trans('auth.first_name'); ?></label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control"  placeholder="<?php echo trans('auth.first_name'); ?>" value="<?php echo old('user_firstname'); ?>" name="user_firstname" autofocus />
	                         <?php 

	                         	if($errors->has('user_firstname')){   ?>

	                         		 <span class="help-block">
	                                        <strong><?php echo $errors->first('user_firstname'); ?></strong>
	                                 </span>
	                        <?php }
	                         ?>
					    </div>
				  	</div>


				  	<div class="form-group<?php echo $errors->has('user_lastname') ? ' has-error' : ''; ?>">
				    <label for="" class="col-sm-5 control-label"><?php echo trans('auth.last_name'); ?></label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" name="user_lastname" value="<?php echo old('user_lastname'); ?>" placeholder="<?php echo trans('auth.last_name'); ?>" />
				      		<?php 
				      			if($errors->has('user_lastname')) {  ?>
									<span class="help-block">
                                        <strong><?php echo $errors->first('user_lastname'); ?></strong>
                                    </span>
				      		<?php }
				      		?>
				    </div>
				  	</div>



					<div class="form-group<?php echo $errors->has('email') ? ' has-error' : ''; ?>">
				     <label for="" class="col-sm-5 control-label"><?php echo trans('auth.phone_number_or_email');  ?></label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" name="email" value="<?php echo old('email'); ?>" placeholder="<?php echo trans('auth.phone_number_or_email');  ?>" />
				      		<?php
				      			if ($errors->has('email')) { ?>
				      				<span class="help-block">
                                        <strong><?php echo $errors->first('email'); ?></strong>
                                    </span>
				      		<?php }
				      		?>
				    </div>
				  	</div>
					<div class="form-group<?php echo $errors->has('password') ? ' has-error' : ''; ?>">
				     <label for="" class="col-sm-5 control-label"><?php echo trans('auth.password');  ?></label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" name="password" value="<?php echo old('password'); ?>" placeholder="<?php echo trans('auth.password');  ?>" />
				     
	                         <?php
	                         	if($errors->has('password'))  {  ?>
	                         	    <span class="help-block">
	                                     <strong><?php echo $errors->first('password'); ?></strong>
	                                  </span>

	                         <?php	}
	                         ?>
				    </div>
				  	</div>


					<div class="form-group<?php echo $errors->has('password_confirmation') ? ' has-error' : ''; ?>">
				     <label for="" class="col-sm-5 control-label"><?php echo trans('auth.password_confirmation'); ?></label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" name="password_confirmation" value="<?php echo old('password_confirmation'); ?>" placeholder="<?php echo trans('auth.password_confirmation'); ?>" />
	                         <?php 
	                         	 if($errors->has('password_confirmation')) { ?>
	                         	 	 <span class="help-block">
	                                        <strong><?php echo $errors->first('password_confirmation'); ?></strong>
	                                    </span>
	                         <?php	}

	                         ?>
				    </div>
				  	</div>
				  	<div class="form-group<?php echo $errors->has('accept_policy') ? ' has-error' : ''; ?>">
	                    <div class="col-md-7 col-md-offset-5">
	                        <div class="checkbox">
	                            <label>
	                                <input type="checkbox" name="accept_policy" /> <a href="#" data-toggle="modal" data-target="#myModal"><?php echo trans('auth.accept_policy'); ?></a>
	                            </label>

	                            <?php
				      			if ($errors->has('accept_policy')) { ?>
				      				<span class="help-block">
                                        <strong><?php echo $errors->first('accept_policy'); ?></strong>
                                    </span>
				      		<?php }
				      		?>

	                        </div>
	                    </div>
	                </div>

				  	<div class="form-group">
				    <div class="col-sm-offset-5 col-sm-7">
				      <button type="submit" class="btn btn-success"><?php echo  trans('auth.register'); ?></button>
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
	    		Already have an account? <a href="<?php echo URL::to('/login'); ?>">Login</a>
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
