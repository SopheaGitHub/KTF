$(document).ready(function() {

  /* for overvew.php */

  $('#load-image').hide();
  $(document).on('click', '.profile-menu', function(e) {
    e.preventDefault();
    var menu = $(this).data('menu');

    $.ajax({
        type: "GET",
        url: 'component/'+menu+'.php',
        data: {"menu":menu},
        cache: false,
        beforeSend: function () {
          $('.li-file-menu').removeClass( "active" );
          $('#'+menu).addClass( "active" );
          $('#load-image').show();
          $('#load-page').html('').show();
        },
        complete: function () {
          $('#load-image').hide();
        },
        success: function (html) {
          $('#load-page').html(html).show();
        },
        error: function (request, status, error) {
            var msg = '';
            msg += '<div class="alert alert-warning" id="warning">';
            msg += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                msg += '<b><i class="fa fa-info-circle"></i> '+error+' </b><br />';
            msg += '</div>';
            $('#load-page').html(msg).show();
        }
    });

  });

  /* end page overview.php */

});

$(document).ready(function(){
  var xH
      $('.dhiraj').hover(
        function () {
          xH = $(this).children("img").css("height");
          xH = parseInt(xH);
          xH = xH - 10;
          xH = "-" + xH + "px";
          $(this).children("img").css("top", xH);
        }, function () {
          $(this).children("img").css("top", "0px");
    });
});

$('#iconified').on('keyup', function() {
    var input = $(this);
    if(input.val().length === 0) {
        input.addClass('search');
    } else {
        input.removeClass('search');
    }
});