@include('component/header')
@include('component/header_profile_menu')
@include('component/left')




<div class="col-md-8">
	<div class="profile clearfix">
        <div class="image">
            <img src="img/download.jpg" style="width:100%;" class="img-cover">
        </div>                            
        <div class="user clearfix">
          <div class="avatar">
              <?php if(isset($data->user_profile) ) {  ?>
                 <?php  foreach ($data->user_profile as $item) { ?>
                  <img src="<?php echo url($item->profile)  ?>"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
                  <?php  }  ?>
             <?php }else { ?>
                  <img src="img/profile_logo_22207730.jpg"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
              <?php }  ?>
          </div>
          
          <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($data->user_name as $key => $item) { ?>
                   <h2><?php  echo $item->user_firstname.' '.$item->user_lastname  ?></h2>
                    <?php
                		}
                    ?>
              <div class="info">
                <p><span class="title"><i class="fa fa-book" aria-hidden="true"></i> Skills :</span>
                  <?php
                  foreach ($data->list_skill as $key => $item) {
					echo $item->skill_title.', ';
                     }
                  ?>
				</p>

                <p><span class="title"><i class="zmdi zmdi-phone-forwarded"></i> Contact:</span> 010922393 | Email : </p>
              	<p>hi i am a  professional graphic designer.i work many online offline project i work since 2 years in  graphic design .i like to show my creativity   i give 100% satisfaction to  client for verified  i am professional graphic designer.
thank you.</p>
              </div>
            </div>
          </div>                                                                                             
        </div>                       
        <!-- <div class="info">
            <p><span class="glyphicon glyphicon-globe"></span> <span class="title">Address:</span>  St. Revutskogo, Kiev, Ukraine</p>                                    
            <p><span class="glyphicon glyphicon-gift"></span> <span class="title">Date of birth:</span> 14.02.1989</p>                                
        </div>  -->                             
    </div>

    <nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <!-- <a class="navbar-brand" href="#">Profile</a> -->
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	        <li class="active li-file-menu" id="overview"><a href="#" class="profile-menu" data-menu="overview">Overview</a></li>
	        <li class="li-file-menu" id="project"><a href="#" class="profile-menu" data-menu="project">Project</a></li>
	        <li class="li-file-menu" id="bid"><a href="#" class="profile-menu" data-menu="bid">Bid</a></li>
	        <li class="li-file-menu" id="showcase"><a href="#" class="profile-menu" data-menu="showcase">Showcase</a></li>
	        <!-- <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	          </ul>
	        </li> -->
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>


	<div style="border: 1px solid #D5D5D5; background:#fff; min-height: 100px;">
		<div id="load-page" style="padding: 20px;">
            @include('component/overview')
		</div>
	</div>
	<br />



</div>



<!-- Modal -->
<div id="upload-profile" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form action="<?php echo $data->url_save_profile_image; ?>" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <span class="glyphicon glyphicon-user"></span> Upload New Profile</h4>
                </div>
                <div class="modal-body">
                    <div id="old_profile">
                        <?php if(isset($data->user_profile) ) {  ?>
                        <?php  foreach ($data->user_profile as $item) { ?>
                        <img src="<?php echo url($item->profile)  ?>" style="width: 200px; height: 200px;  margin: 0 auto;"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
                        <?php  }  ?>
                        <?php }else { ?>
                        <img src="img/profile_logo_22207730.jpg" style="width: 200px; height: 200px;  margin: 0 auto;"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
                        <?php }  ?>
                   </div>
                    <div id="upload-demo" style="display: none;"></div>
                    <input type="hidden" id="image-profile" name="image-profile">
                </div>
                <div class="modal-footer">
                   <!-- <input type="file" class="pull-left" name="image-profile-original"  id="upload" value="Upload"/>-->
                    <label class="btn btn-primary btn-file  pull-left">
                        <span class="glyphicon glyphicon-upload"></span> Browse <input type="file" class="pull-left" name="image-profile-original"  id="upload" value="Upload" style="display: none;">
                    </label>
                    <button type=button class="btn btn-default vanilla-rotate" data-deg="-90"><i class="glyphicon glyphicon-repeat gly-spin"></i></button>
                    <button disabled type="submit"  class="btn btn-success upload-result"> <span class="glyphicon glyphicon-ok"></span> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>
		</form>
	</div>
</div>




@include('component/right')
@include('component/chat')
@include('component/footer')


<link href="<?php echo asset('css/croppie.css')?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo asset('js/croppie.js') ?>"></script>

<script type="text/javascript">
    // =====================> BEGIN CROP <=============
        $( document ).ready(function() {
            var $uploadCrop;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        });
                        $('.upload-demo').addClass('ready');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $uploadCrop = $('#upload-demo').croppie({
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'canvas'
                },
                boundary: {
                    width: 300,
                    height: 300
                },
                showZoomer: true,
                enableExif: true,
                enableOrientation: true
            });

            $('#upload').on('change', function () {
                $('#old_profile').remove();
                $('#upload-demo').show();
                $(":submit").removeAttr("disabled");
                readFile(this);
            });


            $('.vanilla-rotate').on('click', function(ev) {
                $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
            });


            $('.upload-result').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#image-profile').val(resp);
                    $('#form').submit();
                    console.log(resp);
                });

            });

        });

	//===============>END CROP <=============================
</script>


