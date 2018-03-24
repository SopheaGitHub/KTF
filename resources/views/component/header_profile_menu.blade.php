<div class="panel panel-success">
	<div class="panel-heading" style="padding: 0px;">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
			<div class="col-md-9">
				<ul class="nav nav-pills">
					<li><a href="<?php $data->url_home; ?>">LOGO</a></li>
				    <li class="dropdown">
				        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Hire Freelancers <span class="glyphicon glyphicon-triangle-bottom"></span></a>
				        <ul class="dropdown-menu">
				            <li><a href="<?php echo $data->url_post_project; ?>">Post a Project</a></li>
				            <li class="divider"></li>
				            <li><a href="search_freelancer.php">Browse Freelancers</a></li>
				            <li><a href="#">Browse Showcase</a></li>
				        </ul>
				    </li>
				    <li class="dropdown">
				        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Find Work <span class="glyphicon glyphicon-triangle-bottom"></span></a>
				        <ul class="dropdown-menu">
				        	<li><a href="upload_showcase_form.php">Upload Showcase</a></li>
				            <li class="divider"></li>
				            <li><a href="search_project.php">Browse Projects</a></li>
				            <li><a href="skill.php">Browse Categories</a></li>
				        </ul>
				    </li>
				    <li><a href="#">How to use?</a></li>
				</ul>
			</div>
			<div class="col-md-3 text-right" style="margin-top:3px; margin-bottom:3px;">
				<a href="<?php echo $data->url_post_project; ?>" class="btn btn-sm btn-success">Post a Project</a>
				<button class="btn btn-sm btn-success">Upload Showcase</button>
			</div>
		</div>
	</div>
	<div class="panel-body" style="margin:0px; padding:2px 10px;">
		<div class="text-right">
			<a href="<?php echo $data->url_profile; ?>"> <img src="img/user-453533-fdadfd.png" style="width:30px;"></a> &nbsp;&nbsp;&nbsp;
			<ul class="nav nav-pills pull-right">
			    <li class="dropdown">
			        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-comment"></span> <span style="position:absolute; top:0;">2</span></a>
			        <ul class="dropdown-menu">
			            <li>
			            	<div style="padding: 10px;">
			            		<div>New Message</div>
			            		<div style="height: 50px;">

			            		</div>
			            		<div class="text-center"><a href="#">See All</a></div>
			            	</div>
			            </li>
			        </ul>
			    </li>
			    <li class="dropdown">
			        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-globe"></span> <span style="position:absolute; top:0;">5</span></a>
			        <ul class="dropdown-menu">
			            <li>
			            	<div style="padding: 10px;">
			            		<div>Notification</div>
			            		<div style="height: 50px;">

			            		</div>
			            		<div class="text-center"><a href="#">See All</a></div>
			            	</div>
			            </li>
			        </ul>
			    </li>
			    <li class="dropdown">
			        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
			        <ul class="dropdown-menu">
			            <li><a href="<?php $data->url_skill; ?>">Skill</a></li>
			        	<li><a href="#">About</a></li>
			            <li class="divider"></li>
			            <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
			        </ul>
			    </li>
			</ul>
		</div>
	</div>
</div>