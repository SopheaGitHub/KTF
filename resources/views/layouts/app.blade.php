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
    <link href="<?php echo asset('css/star-rating.css') ?>" media="all" rel="stylesheet" type="text/css"/>

    <!-- ===================> NOTIFY <=================================== -->
    <link href="<?php echo asset('vendor\notifyjs/dist/styles/metro/notify-metro.css" rel="stylesheet') ?>" />
    <!-- ===================> NOTIFY <=================================== -->

    <script src="<?php echo asset('vendor/jquery/jquery-2.1.1.min.js')?>"></script>
    <script src="<?php echo asset('vendor/jquery/js/jquery-ui.js')?>"> </script>
    <script src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo asset('js/star-rating.js') ?>" type="text/javascript"></script>

    @yield('css')

</head>
<body>


@yield('content')


<script src="<?php echo asset('js/app.js')?>"> </script>
<script src="<?php echo asset('js/chat.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/notify.js')?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/styles/metro/notify-metro.js')?>"></script>

@yield('script')

</body>
</html>