@extends('layouts.profile_app')

@section('content')

    <style>
    .camera {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 12px;
        color: #db8629;
        width: 115px;
        text-align: center;
        /* margin-left: -15px; */
        /* border: 1px solid #efefef; */
        color: #fff;
        padding: 5px;
        border-radius: 2px;
        text-shadow: 1px 1px 1px #000;
        cursor: pointer;
    }
    .camera:hover {
        background-clip: padding-box;
        background-color: #000;
        box-shadow: 0 0 6px rgba(0, 0, 0, .6);
        opacity: .8;
    }

    #upload-cover .modal-dialog{
        max-height: 1000px;
        width: 900px !important;
        padding: 15px;
    }

</style>




<div class="col-md-8">
	<div class="profile clearfix">
        <div class="image">

            <?php  foreach ($data->user_profile as $item) {
                if (!empty($item->cover)) {   ?>
            <img src="<?php echo url($item->cover)  ?>" style="width:100%;"  style="width:100%;" class="img-cover" >
            <?php } else { ?>
            <img src="img/download.jpg" style="width:100%;"  style="width:100%;" class="img-cover" >
            <?php }
            }
            ?>

            <div  class="camera" data-toggle="modal" data-target="#upload-cover">
                <i class="fa fa-camera"></i> Update cover
            </div>

        </div>                            
        <div class="user clearfix">
          <div class="avatar">
              <?php  foreach ($data->user_profile as $item) {
                 if (!empty($item->profile)) {   ?>
                  <img src="<?php echo url($item->profile)  ?>"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
             <?php }else { ?>
                  <img src="img/profile_logo_22207730.jpg"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
              <?php }
              } ?>
          </div>
          
          <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($data->user_name as $key => $item) { ?>
                   <h2><?php  echo html_entity_decode($item->user_firstname.' '.$item->user_lastname)  ?></h2>
                    <?php
                		}
                    ?>
              <div class="info">
                <p><span class="title"><i class="fa fa-book" aria-hidden="true"></i> Skills :</span>
                  <?php
                    $cnt = 0;
                  foreach ($data->list_skill as $key => $item) {
                      $cnt++;
                      if($cnt == count($data->list_skill)){
                          echo $item->skill_title;
                      }else{
                          echo $item->skill_title.', ';
                      }

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
                    <div id="old_profile" style="text-align: center;" >
                        <?php  foreach ($data->user_profile as $item) {
                            if(!empty($item->profile)) {
                         ?>
                        <img src="<?php echo url($item->profile)  ?>" style="width: 200px; height: 200px;"  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
                        <?php } else { ?>
                        <img src="img/profile_logo_22207730.jpg" style="width: 200px; height: 200px; "  class="img-thumbnail img-profile" data-toggle="modal" data-target="#upload-profile">
                        <?php }
                        }?>
                   </div>
                    <div id="upload-demo" style="display: none;"></div>
                    <input type="hidden" id="image-profile" name="image-profile">
                </div>
                <div class="modal-footer">
                   <!-- <input type="file" class="pull-left" name="image-profile-original"  id="upload" value="Upload"/>-->
                    <label class="btn btn-primary btn-file  pull-left">
                        <span class="glyphicon glyphicon-upload"></span> Browse <input type="file" class="pull-left" name="image-profile-original"  id="upload" value="Upload" style="display: none;">
                    </label>
                    <button disabled type=button class="btn btn-default vanilla-rotate-profile" data-deg="-90"><i class="glyphicon glyphicon-repeat gly-spin"></i></button>
                    <button disabled type="submit"  class="btn btn-success upload-result-profile"> <span class="glyphicon glyphicon-ok"></span> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>
		</form>
	</div>
</div>





<!-- Modal -->
<div id="upload-cover" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo $data->url_save_cover_image; ?>" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <span class="glyphicon glyphicon-picture"></span> Upload New Cover</h4>
                </div>
                <div class="modal-body">
                    <div id="old_cover">
                        <?php  foreach ($data->user_profile as $item) {
                            if(!empty($item->cover)) { ?>
                        <img src="<?php echo url($item->cover)  ?>" style="width:100%;"  class="img-thumbnail ">
                        <?php } else { ?>
                        <img src="img/profile_logo_22207730.jpg" style="width:100%;"  class="img-thumbnail ">
                        <?php }
                        }?>
                    </div>
                    <div id="upload-cover-demo" style="display: none;"></div>
                    <input type="hidden" id="image-cover" name="image-cover">
                </div>
                <div class="modal-footer">
                    <label class="btn btn-primary btn-file  pull-left">
                        <span class="glyphicon glyphicon-upload"></span> Browse <input type="file" class="pull-left" name="image-profile-original"  id="upload_cover" value="Upload-cover" style="display: none;">
                    </label>
                    <button disabled type=button class="btn btn-default vanilla-rotate-cover" data-deg="-90"><i class="glyphicon glyphicon-repeat gly-spin"></i></button>
                    <button disabled type="submit"  class="btn btn-success upload-cover-result"> <span class="glyphicon glyphicon-ok"></span> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>




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
                $('.upload-result-profile').removeAttr("disabled");
                $('.vanilla-rotate-profile').removeAttr("disabled");
                readFile(this);
            });


            $('.vanilla-rotate-profile').on('click', function(ev) {
                $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
            });


            $('.upload-result-profile').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#image-profile').val(resp);
                    $('#form').submit();
                    console.log(resp);
                });

            });



            // ================> BEGIN UPLOAD COVER <=============

            var $uploadCropCover;

            function readFileCover(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $uploadCropCover.croppie('bind', {
                            url: e.target.result
                        });
                        $('.upload-cover-demo').addClass('ready');
                    }
                    reader.readAsDataURL(input.files[0]);
                    console.log(input.files[0]);
                }else{
                    console.log("else");
                }
            }

            $uploadCropCover = $('#upload-cover-demo').croppie({
                viewport: {
                    width: 700,
                    height: 300,
                    type: 'canvas'
                },
                boundary: {
                    width: 700,
                    height: 400,
                },
                showZoomer: true,
                enableExif: true,
                enableOrientation: true
            });

            $('#upload_cover').on('change', function () {
                $('#old_cover').remove();
                $('#upload-cover-demo').show();
                $('.upload-cover-result').removeAttr("disabled");
                $('.vanilla-rotate-cover').removeAttr("disabled");
                readFileCover(this);
            });


            $('.vanilla-rotate-cover').on('click', function(ev) {
                $uploadCropCover.croppie('rotate', parseInt($(this).data('deg')));
            });


            $('.upload-cover-result').on('click', function (ev) {
                $uploadCropCover.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#image-cover').val(resp);
                    $('#form').submit();
                    console.log(resp);
                });

            });

            //================> END UPLOAD COVER <================

        });

	//===============>END CROP <=============================
</script>

@endsection


