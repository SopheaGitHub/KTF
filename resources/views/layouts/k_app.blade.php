<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/jquery/css/jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('fonts/iconic/css/material-design-iconic-font.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/chat/emoji-picker-master/lib/css/emoji.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/chat/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/chat.css'); ?>">

    <!-- ===================> NOTIFY <=================================== -->
    <link href="<?php echo asset('vendor/notifyjs/dist/styles/metro/notify-metro.css" rel="stylesheet'); ?>" />
    <!-- ===================> NOTIFY <=================================== -->

    <script src="<?php echo asset('vendor/jquery/jquery-2.1.1.min.js'); ?>"></script>
    <script src="<?php echo asset('vendor/jquery/js/jquery-ui.js'); ?>"> </script>
    <script src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset('js/chat_box.js')?>"></script>

    @yield('css')

</head>
<body>
<div id="chat-realtime">
<div id="main">
<div class="panel panel-success">
    <div class="panel-heading" style="padding: 0px;">
        <div class="row" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-md-9">
                <ul class="nav nav-pills">
                    <li><a href="<?php echo url('/'); ?>" style="padding: 0px; padding-top:2px; padding-right:15px;"><img src="<?php echo url('/image/h30.png'); ?>" alt="LOGO"></a></li>
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
                <li><a href="login.php" style="padding: 5px 15px;">Login</a></li>
                <li><a href="register.php" style="padding: 5px 15px;">Join Us</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-2">@include('include.content_left')</div>
<div class="col-md-8">@yield('content')</div>
<div class="col-md-2">@include('include.content_right')</div>

@include('include.chat')

</div>
</div>

<!-- Firebase -->
<script src="<?php echo asset('vendor/chat/firebase/firebase.js'); ?>"></script>
<script src="<?php echo asset('vendor/chat/firebase/firebase-app.js'); ?>"></script>
<script src="<?php echo asset('vendor/chat/firebase/firebase-database.js'); ?>"></script>

<script src="<?php echo asset('js/app.js'); ?>"> </script>
<script src="<?php echo asset('js/chat.js'); ?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/notify.js'); ?>"></script>
<script src="<?php echo asset('vendor/notifyjs/dist/styles/metro/notify-metro.js'); ?>"></script>

<!-- chat_realtime -->
<script type="text/javascript" src="<?php echo asset('js/chat/config.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/chat/chat_realtime.js'); ?>"></script>

@yield('script')

<script>
$(function(){

    var userlogin = false;

    // cek user session
    $.ajax({
        url: "<?php echo url('/'); ?>/"+apis,
        data: {
            data: 'cek'
        },
        type: "post",
        crossDomain: true,
        dataType: 'json',
        success: function(a) {
            // console.log(a);
            // return false;
            if (a.status == 'success') {
                    var x = new Date(),
                        b = x.getDate(),
                        c = (x.getMonth() + 1),
                        d = x.getFullYear(),
                        e = x.getHours(),
                        f = x.getMinutes(),
                        g = x.getSeconds(),
                        date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
                    var h = {
                        user_id: a.user,
                        profile: a.profile,
                        login: date,
                        tipe: 'login'
                    };
                    userRef.push(h);
                $('#login').hide();
                $('#main').show();
                document.querySelector('#avatarlogin').src = a.profile;
                userlogin = a.user;
                $('#userlogin').html(a.user);
                chat_realtime(userRef, messageRef, "<?php echo url('/'); ?>/"+apis, a.user, a.profile, imageDir)
            }
        }
    });

    // user logout
    $('#logout').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo url('/'); ?>/"+apis,
            data: {
                data: 'logout'
            },
            type: "post",
            crossDomain: true,
            dataType: 'json',
            success: function(a) {
                if (a.status == 'success') {
                    var b = {
                        user_id: userlogin,
                        tipe: 'logout'
                    };
                    userRef.push(b);
                    setTimeout( function() {
                        window.location.href = "index.php";
                    }, 1500 );
                }
            }
        })
    });
    
    // user login
    $('#loginform').submit(function(e) {
        e.preventDefault();
        var i = $('#user-id').val(),
            profile = $('#profile').val();
        if (i != '' && profile != '') {
            $('#status').html('<center>Wait...</center>');
            $.ajax({
                url: "<?php echo url('/'); ?>/"+apis,
                data: {
                    data: 'login',
                    user_id: i,
                    profile: profile
                },
                type: "post",
                crossDomain: true,
                dataType: 'json',
                success: function(a) {
                    // console.log(a);
                    // return false;
                    if (a.status == 'success') {
                        var x = new Date(),
                            b = x.getDate(),
                            c = (x.getMonth() + 1),
                            d = x.getFullYear(),
                            e = x.getHours(),
                            f = x.getMinutes(),
                            g = x.getSeconds(),
                            date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
                        var h = {
                            user_id: i,
                            profile: profile,
                            login: date,
                            tipe: 'login'
                        };
                        userRef.push(h);
                    } else {
                        $('#status').html("<div class='alert alert-danger'>false user login.</div>")
                    }
                }
            })
        } else {
            alert('Form input ada yang belum di isi')
        }
    });
    
    $('#main').show();
  
});

</script>


</body>
</html>



