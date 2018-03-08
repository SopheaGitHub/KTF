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

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

	@yield('css')

</head>
<body>