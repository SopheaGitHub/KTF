@extends('layouts.k_app')

@section('css')
<style type="text/css">
	.contrat_title{
		font-size: 18px;
		color: #5cb85c;
	}
</style>
@endsection

@section('content')

<div class="panel panel-success">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="profile.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to profile"></i></a></li>
		  	<li><a href="home.blade.php">Home</a></li>
		  	<li><a href="profile.php">Profile</a></li>
		  	<li class="active">Register Succcess</li>
		</ol>
	</div>
	<div class="panel-body">
		<div class="contrat_title"><em>Congratulations!</em></div>
	    <hr />

	    <form class="form-horizontal">
			
	    	<div><b>What can i help you?</b></div>
			<div class="row">
				<a href="<?php echo URL::to('/freelancer/post_project_form'); ?>">
					<div class="col-md-3">
		      			<div class="category-box" data-toggle="modal" data-target="#myModal1"><i style="font-size:100px;" class="zmdi zmdi-flower-alt mdc-text-green"></i><br /> <b>I want to hire freelancer.</b></div>
		      		</div>
	      		</a>

				<a href="<?php echo URL::to('/freelancer/skill'); ?>">
		      		<div class="col-md-3">
		      			<div class="category-box" data-toggle="modal" data-target="#myModal2"><i style="font-size:100px;" class="zmdi zmdi-notifications-active animated infinite pulse zmdi-hc-fw mdc-text-blue"></i><br /><b>I want to find work.</b></div>
		      		</div>
	      		</a>
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
    	var title =" <?php echo $data->title; ?>";
    	var message =" <?php echo $data->message; ?>";

        $.notify({
            title: title,
            text: message,
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
