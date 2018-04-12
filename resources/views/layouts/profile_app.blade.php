<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/jquery/css/jquery-ui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('fonts/iconic/css/material-design-iconic-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/app.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/chat.css') ?>">

    <!-- ===================> NOTIFY <=================================== -->
    <link href="<?php echo asset('vendor\notifyjs/dist/styles/metro/notify-metro.css" rel="stylesheet') ?>" />
    <!-- ===================> NOTIFY <=================================== -->


    <script src="<?php echo asset('vendor/jquery/jquery-2.1.1.min.js')?>"></script>
    <script src="<?php echo asset('vendor/jquery/js/jquery-ui.js')?>"> </script>
    <script src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js')?>"></script>

    @yield('css')

</head>
<body>
<!--Header Profile Menu-->

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

<!--Header Profile Menu-->

<!--Left-->
<div class="col-md-2">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
        </div>
        <div class="panel-body">
            <div class="list-group" style="margin-bottom:0px;">
                <a href="#" class="list-group-item">Art <span class="badge">12</span></a>
                <a href="#" class="list-group-item">Design <span class="badge">5</span></a>
                <a href="#" class="list-group-item">Photography <span class="badge">3</span></a>
                <a href="#" class="list-group-item">Web Develop <span class="badge">3</span></a>
                <a href="#" class="list-group-item">Mobile App <span class="badge">3</span></a>
            </div>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Favorite Tags</h3>
        </div>
        <div class="panel-body">

            <button type="button" class="btn btn-default btn-xs">Graphic Design</button>
            <button type="button" class="btn btn-default btn-xs">Logo</button>
            <button type="button" class="btn btn-default btn-xs">Design</button>
            <button type="button" class="btn btn-default btn-xs">Logo Design</button>
        </div>
    </div>
</div>
<!--Left-->

@yield('content')

<!--Right-->
<div class="col-md-2">
    <div class="panel panel-success">
        <!-- <div class="panel-heading">
          <h3 class="panel-title">Benefits</h3>
        </div> -->
        <div class="panel-body">
            <h5>Benefits</h5>
            <hr />
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Find experts, you can trust by browsing their samples of showcase or previous work and reading their profile reviews.</p>
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> You’ll receive free bids from talented freelancers immediately.</p>
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> You can diractly contact via live chat with your freelancers to get constant updates on the progress of your work.</p>
        </div>
    </div>
    <div class="panel panel-success">
        <!-- <div class="panel-heading">
          <h3 class="panel-title">Benefits</h3>
        </div> -->
        <div class="panel-body">
            <h5>For freelancers</h5>
            <hr />
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Opportunity of bid projects to work.</p>
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Diractly contact via live chat with your customer to get constant updates on the progress of your work.</p>
            <p style="text-align: left;"><i style="font-size:20px; color:#5cb85c;" class="zmdi zmdi-check-circle"></i> Showcase your talent to people around the world.</p>
        </div>
    </div>
    <div style="margin-bottom: 50px;">&nbsp;</div>
</div>
<!--Right-->


<!--Chat-->
<div class="container">
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12" style="padding-right: 0px;">
            <div class="panel panel-success">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <!-- <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a> -->
                    </div>
                </div>
                <div class="panel-body msg_container_base" style="padding-top:10px;">
                    <div class="media user-chat-box">
                        <div class="media-left media-top">
                            <img class="media-object img-thumbnail" src="img/profile_logo_22207730.jpg" style="width:50px;" alt="name">
                        </div>
                        <div class="media-body">
                            <div class="media-name">
                                Namo
                            </div>
                            <div class="media-skill">
                                Photoshop, Illust ...
                            </div>
                        </div>
                    </div>
                    <div class="media user-chat-box">
                        <div class="media-left media-top">
                            <img class="media-object img-thumbnail" src="img/profile_logo_22207730.jpg" style="width:50px;" alt="name">
                        </div>
                        <div class="media-body">
                            <div class="media-name">
                                Namo
                            </div>
                            <div class="media-skill">
                                Photoshop, Illust ...
                            </div>
                        </div>
                    </div>
                    <div class="media user-chat-box">
                        <div class="media-left media-top">
                            <img class="media-object img-thumbnail" src="img/profile_logo_22207730.jpg" style="width:50px;" alt="name">
                        </div>
                        <div class="media-body">
                            <div class="media-name">
                                Namo
                            </div>
                            <div class="media-skill">
                                Photoshop, Illust ...
                            </div>
                        </div>
                    </div>
                    <div class="media user-chat-box">
                        <div class="media-left media-top">
                            <img class="media-object img-thumbnail" src="img/profile_logo_22207730.jpg" style="width:50px;" alt="name">
                        </div>
                        <div class="media-body">
                            <div class="media-name">
                                Namo
                            </div>
                            <div class="media-skill">
                                Photoshop, Illust ...
                            </div>
                        </div>
                    </div>
                    <div class="media user-chat-box">
                        <div class="media-left media-top">
                            <img class="media-object img-thumbnail" src="img/profile_logo_22207730.jpg" style="width:50px;" alt="name">
                        </div>
                        <div class="media-body">
                            <div class="media-name">
                                Namo
                            </div>
                            <div class="media-skill">
                                Photoshop, Illust ...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="background-color: #f5f8fa;">
                    <input id="btn-input iconified" type="text" class="form-control input-sm chat_input search" placeholder="&#xF002; Search ..." />
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="btn-group dropup">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-cog"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="new_chat"><span class="glyphicon glyphicon-triangle-top"></span> Novo</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>
            <li class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-eye-close"></span> Invisivel</a></li>
        </ul>
    </div> -->
</div>
<!--Chat-->


<!--Footer-->
<script src="<?php echo asset('js/app.js')?>"> </script>
<script src="<?php echo asset('js/chat.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/notify.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/styles/metro/notify-metro.js')?>"></script>

@yield('script')

</body>
</html>
<!--Footer-->


