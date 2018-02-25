<html>
<body>
<head>
	<link href="<?php echo asset('/dist/styles/metro/notify-metro.css" rel="stylesheet') ?>" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="<?php echo asset('/dist/notify.js') ?>"></script>
	<script src="<?php echo asset('/dist/styles/metro/notify-metro.js') ?>"></script>
</head>

<h2>Index</h2>

<button onclick="notify('white')">White</button>
<button onclick="notify('black')">Black</button>
<button onclick="notify('error')">Err</button>
<button onclick="notify('success')">Success</button>
<button onclick="notify('warning')">Warning</button>
<button onclick="notify('info')">Info</button>

<div style="background-image:url('/Content/mail.png')"></div>

<script type="text/javascript">
    function notify(style) {
        $.notify({
            title: 'Alert',
            text: 'Congratulation your registration successfully',
            image: "<img src='images/Mail.png'/>"
        }, {
            style: 'metro',
            className: style,
            autoHide: false,
            clickToHide: true
        });
    }
</script>
</body>
</html>