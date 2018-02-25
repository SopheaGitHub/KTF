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
		<div><b>Congratulations</b></div>
	    <hr />

	    <form class="form-horizontal">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label for="" class="col-sm-3 control-label">Who you are ?</label>
					    <div class="col-sm-12">
					      	<div class="row">
					      		<div class="col-md-2">
					      		</div>
					      		<div class="col-md-5">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal1"><i style="font-size:100px;" class="zmdi zmdi-flower-alt mdc-text-green"></i><br /> <b>Do you want to hire freelancer?</b></div>
					      		</div>
					      		<div class="col-md-5">
					      			<div class="category-box" data-toggle="modal" data-target="#myModal2"><i style="font-size:100px;" class="zmdi zmdi-notifications-active animated infinite pulse zmdi-hc-fw mdc-text-blue"></i><br /><b>Are you a freelancer?</b></div>
					      		</div>
					      	</div>
					    </div>
				  	</div>

					

		  	
		</form>

	</div>
</div>
@endsection


@section('script')

<script type="text/javascript">
	notify('success');
    function notify(style) {
    	var image = "<?php echo URL::to('/img/ic_success.png'); ?>";
        $.notify({
            title: 'Alert',
            text: 'Congratulation your registration successfully.',
            image: "<img src='"+image+"'/>"
        }, {
            style: 'metro',
            className: style,
            autoHide: true,
            clickToHide: true
        });
    }
</script>
@endsection
