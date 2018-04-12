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

<div class="panel panel-success">
    <div class="panel-heading" style="padding: 0px;">
        <div class="row" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-md-9">
                <ul class="nav nav-pills">
                    <li><a href="home.php">LOGO</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Hire Freelancers <span class="glyphicon glyphicon-triangle-bottom"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="post_project_form.php">Post a Project</a></li>
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
                <a href="post_project_form.php" class="btn btn-sm btn-success">Post a Project</a>
                <button class="btn btn-sm btn-success">Upload Showcase</button>
            </div>
        </div>
    </div>
    <div class="panel-body" style="margin:0px; padding:2px 15px;">
        <div class="text-right">
            <ul class="nav nav-pills pull-right">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Join Us</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-2">@include('include.content_left')</div>
<div class="col-md-8">@yield('content')</div>
<div class="col-md-2">@include('include.content_right')</div>

<script src="<?php echo asset('js/app.js')?>"> </script>
<script src="<?php echo asset('js/chat.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/notify.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/styles/metro/notify-metro.js')?>"></script>

@yield('script')

</body>
</html>



