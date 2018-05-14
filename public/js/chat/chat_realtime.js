/*****************************************************
* #### Chat Realtime (BETA) ####
* Coded by Ican Bachors 2016.
* https://github.com/bachors/Chat-Realtime
* Updates will be posted to this site.
* Aplikasi ini akan selalu bersetatus (BETA) 
* Karena akan terus di update & dikembangkan.
* Maka dari itu jangan lupa di fork & like ya sob :).
*****************************************************/

var chat_realtime = function(j, k, l, m, n, imageDir) {
	
	var uKe = 'public',
    uTipe = 'rooms',
    tampungImg = [];

    userMysql();

    j.on("child_added", function(a) {
        // console.log("added", a.key, a.val());
        // console.log(a.val());
        // console.log(m);
        // return false;
        if (a.val().tipe == 'login') {
            if (a.val().user_id != m) {
                if ($('#s' + a.val().user_id).length) {
                    $('#s' + a.val().user_id + ' .fa-circle').addClass('online');
                    $('#s' + a.val().user_id + ' .time').html(timing(new Date(a.val().login)))
                } else {
                    var b = '<li id="s' + a.val().user_id + '" class="user bounceInDown" data-tipe="users" data-uid="' + a.val().user_id + '" data-uname="' + a.val().user_id + '">';
                    b += '  <a href="#" class="clearfix">';
                    b += '      <img src="' + a.val().profile + '" alt="' + a.val().user_id + '" class="img-circle">';
                    b += '      <div class="users-name">';
                    b += '          <i class="fa fa-circle online"></i> <strong>' + a.val().user_id + '</strong>';
                    b += '      </div>';
                    b += '      <div class="last-message msg"></div>';
                    b += '      <small class="time text-muted">' + timing(new Date(a.val().login)) + '</small>';
                    b += '      <small class="chat-alert label label-primary">0</small>';
                    b += '  </a>';
                    b += '</li>';
                    $('.users-list').prepend(b)
                }
            }
        } else {
            $('#s' + a.val().user_id + ' .fa-circle').removeClass('online')
        }
        j.child(a.key).remove()
    });

    k.on("child_added", function(a) {

        // console.log("added", a.key, a.val());
        // return false;

        var b = a.val().sender_id,
            ke = a.val().receiver_id;
        
        // inbox user
        if (ke == m) {
            document.querySelector('#s' + b + ' .time').innerHTML = timing(new Date(a.val().date));
            document.querySelector('#s' + b + ' .last-message').innerHTML = '<i class="fa fa-reply"></i> ' + htmlEntities(a.val().message);
            if ($('#s' + b).hasClass('active')) {
                document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
            } else {
                $('#s' + b + ' .chat-alert').show();
                document.querySelector('#s' + b + ' .chat-alert').innerHTML = (parseInt(document.querySelector('#s' + b + ' .chat-alert').innerHTML) + 1)
            }
        }
        
        // inbox room
        else if (ke != m && $('#s' + ke).data('tipe') == 'rooms') {
            document.querySelector('#s' + ke + ' strong').innerHTML = a.val().sender_id;
            document.querySelector('#s' + ke + ' img').src = a.val().profile;
            document.querySelector('#s' + ke + ' .time').innerHTML = timing(new Date(a.val().date));
            document.querySelector('#s' + ke + ' .last-message').innerHTML = htmlEntities(a.val().message);
            if ($('#s' + ke).hasClass('active')) {
                document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
            } else {
                $('#s' + ke + ' .chat-alert').show();
                document.querySelector('#s' + ke + ' .chat-alert').innerHTML = (parseInt(document.querySelector('#s' + ke + ' .chat-alert').innerHTML) + 1)
            }
        }
        
        // send message
        else if (b == m) {
            document.querySelector('#s' + ke + ' .time').innerHTML = timing(new Date(a.val().date));
            document.querySelector('#s' + ke + ' .last-message').innerHTML = '<i class="fa fa-check"></i> ' + htmlEntities(a.val().message);
            document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
        }
        var c = $('.chat');
        var d = c[0].scrollHeight;
        c.scrollTop(d);
        k.child(a.key).remove()
    });

    //send chat
    document.querySelector('#sendchat').addEventListener("click", function(h) {
        var a = new Date(),
            b = a.getDate(),
            c = (a.getMonth() + 1),
            d = a.getFullYear(),
            e = a.getHours(),
            f = a.getMinutes(),
            g = a.getSeconds(),
            date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
        h.preventDefault();
        var il = tampungImg.length;
        if (document.querySelector('#message').value != '') {
            
            // insert mysql
            $.ajax({
                url: l,
                type: "post",
                data: {
                    data: 'send',
                    sender_id: m,
                    receiver_id: uKe,
                    message: document.querySelector('#message').value,
                    images : JSON.stringify(tampungImg),
                    tipe: uTipe,
                    date: date
                },
                crossDomain: true,
                success: function(a) {                  
                    // insert firebase
                    if(il > 0){
                        for (hit = 0; hit < il; hit++) {
                            if(hit == 0){                               
                                var i = {
                                    data: 'send',
                                    sender_id: m,
                                    receiver_id: uKe,
                                    profile: n,
                                    message: document.querySelector('#message').value,
                                    images : tampungImg[hit].name,
                                    tipe: uTipe,
                                    date: date
                                };
                            }else{                              
                                var i = {
                                    data: 'send',
                                    sender_id: m,
                                    receiver_id: uKe,
                                    profile: n,
                                    message: '',
                                    images : tampungImg[hit].name,
                                    tipe: uTipe,
                                    date: date
                                };
                            }
                            k.push(i);                  
                        } 
                    }else{

                        var i = {
                            data: 'send',
                            sender_id: m,
                            receiver_id: uKe,
                            profile: n,
                            message: document.querySelector('#message').value,
                            images : '',
                            tipe: uTipe,
                            date: date
                        };
                        
                        // push firebase
                        k.push(i);
                    }
                    tampungImg = [];
                    document.querySelector('#message').value = '';
                    // document.querySelector('.emoji-wysiwyg-editor').innerHTML = '';
                    // document.getElementById('reviewImg').innerHTML = '';
                }
            });
            
        } else {
            alert('Please fill atlease message!')
        }
    }, false);

    $('body').on('click', '.user', function() {

        var uid = $(this).data("uid");
        var uname = $(this).data('uname');

        // register_popup(uid, uname);
        
        $("#chatroom-popup-head-left").html(uname).show();

        document.getElementById("chatroom").style.display = "block";

        $('.chat').html('');
        $('.user').removeClass("active");
        $(this).addClass("active");
        var a = $(this).attr('id'),
            tipe = $(this).data('tipe');
        $('#' + a + ' .chat-alert').hide();
        $('#' + a + ' .chat-alert').html(0);

        // uKe = a;
        uKe = uid;
        uTipe = tipe;
        chatMysql(tipe, a);
        return false
    });

    function userMysql() {
        $.ajax({
            url: l,
            type: "post",
            data: 'data=user',
            crossDomain: true,
            dataType: 'json',
            success: function(a) {
                // console.log(a);
                // return false;
                var b = '';
                $.each(a, function(i, a) {
                    if (a.user_id != m) {
                        b += '<li id="s' + a.user_id + '" class="user bounceInDown" data-tipe="users" data-uid="' + a.user_id + '" data-uname="' + a.user_name + '">';
                        b += '  <a href="#" class="clearfix">';
                        b += '      <img src="' + a.profile + '" alt="' + a.user_id + '" class="img-circle">';
                        b += '      <div class="users-name">';
                        b += '          <i class="fa fa-circle ' + (a.login_status == 'online' ? 'online' : '') + '"></i> <strong>' + a.user_name + '</strong>';
                        b += '      </div>';
                        b += '      <div class="last-message msg"></div>';
                        b += '      <small class="time text-muted">' + timing(new Date(a.login)) + '</small>';
                        b += '      <small class="chat-alert label label-primary">0</small>';
                        b += '  </a>';
                        b += '</li>'
                    }
                });
                $('.users-list').html(b);
                chatMysql('rooms', 'all');
                chatMysql('users', 'all');
            }
        })
    }

    function chatFirebase(a) {
        // console.log(a);
        // return false; 
        var b = '';
        if (a.sender_id == m) {
            b = '<li class="right clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-right">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<p class="msg">' + (a.images != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.images+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '</li>'
        } else {
            b = '<li class="left clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-left">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<div class="kepala">' + '<strong class="primary-font">' + a.sender_id + '</strong>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '<p class="msg">' + (a.images != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.images+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '</div>' + '</li>'
        }
        return b
    }

    function chatMysql(e, f) {
        $.ajax({
            url: l,
            type: "post",
            data: {
                data: 'message',
                receiver_id: f,
                tipe: e
            },
            crossDomain: true,
            dataType: 'json',
            success: function(a) {
                // console.log(a);
                // console.log(f);
                // return false;
                var b = '';
                if (f == 'all') {
                    $.each(a, function(i, a) {
                        if ($('#s' + a.selektor).hasClass('active')) {
                            if (a.sender_id == m) {
                                b += '<li class="right clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-right">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<p class="msg">' + (a.image != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.image+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '</li>'
                            } else {
                                b += '<li class="left clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-left">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<div class="kepala">' + '<strong class="primary-font">' + a.sender_id + '</strong>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '<p class="msg">' + (a.image != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.image+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '</div>' + '</li>'
                            }
                        }
                        if (a.tipe == 'users') {
                            document.querySelector('#s' + a.selektor + ' .time').innerHTML = timing(new Date(a.date));
                            document.querySelector('#s' + a.selektor + ' .last-message').innerHTML = (a.sender_id == m ? '<i class="fa fa-check"></i> ' + htmlEntities(a.message) : '<i class="fa fa-reply"></i> ' + htmlEntities(a.message))
                        }
                    });
                    $('.chat').prepend(b);
                } else {
                    $.each(a, function(i, a) {
                        if (a.sender_id == m) {
                            b += '<li class="right clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-right">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<p class="msg">' + (a.image != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.image+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '</li>'
                        } else {
                            b += '<li class="left clearfix s' + a.sender_id + '">' + '<span class="chat-img pull-left">' + '<img src="' + a.profile + '" alt="User Avatar">' + '</span>' + '<div class="chat-body clearfix">' + '<div class="kepala">' + '<strong class="primary-font">' + a.sender_name + '</strong>' + '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> ' + timing(new Date(a.date)) + '</small>' + '</div>' + '<p class="msg">' + (a.image != '' ? '<img class="imageDir" src="'+imageDir+'/'+a.image+'"/>' : '') + urltag(htmlEntities(a.message)) + '</p>' + '</div>' + '</li>'
                        }
                        if (a.tipe == 'users') {
                            document.querySelector('#' + f + ' .time').innerHTML = timing(new Date(a.date));
                            document.querySelector('#' + f + ' .last-message').innerHTML = (a.sender_id == m ? '<i class="fa fa-check"></i> ' + htmlEntities(a.message) : '<i class="fa fa-reply"></i> ' + htmlEntities(a.message))
                        }
                    });
                    $('.chat').prepend(b);
                }

                var c = $('.chat');
                var d = c[0].scrollHeight;
                c.scrollTop(d)
            }
        })
    }

    function htmlEntities(a) {
        return String(a).replace(/</g, '&lt;').replace(/>/g, '&gt;')
    }

    function timing(a) {
        var s = Math.floor((new Date() - a) / 1000),
            i = Math.floor(s / 31536000);
        if (i > 1) {
            return i + " yrs ago"
        }
        i = Math.floor(s / 2592000);
        if (i > 1) {
            return i + " mon ago"
        }
        i = Math.floor(s / 86400);
        if (i > 1) {
            return i + " dys ago"
        }
        i = Math.floor(s / 3600);
        if (i > 1) {
            return i + " hrs ago"
        }
        i = Math.floor(s / 60);
        if (i > 1) {
            return i + " min ago"
        }
        return (Math.floor(s) > 0 ? Math.floor(s) + " sec ago" : "just now")
    }
    
    function urltag(d, e) {
        var f = {
            yutub: {
                regex: /(^|)(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*)(\s+|$)/ig,
                template: "<iframe class='yutub' src='//www.youtube.com/embed/$3' frameborder='0' allowfullscreen></iframe>"
            },
            link: {
                regex: /((^|)(https|http|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,
                template: "<a href='$1' target='_BLANK'>$1</a>"
            },
            email: {
                regex: /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi,
                template: '<a href=\"mailto:$1\">$1</a>'
            }
        };
        var g = $.extend(f, e);
        $.each(g, function(a, b) {
            d = d.replace(b.regex, b.template)
        });
        return d
    }
    
    // upload images
    function convertDataURIToBinary(dataURI) {
        var BASE64_MARKER = ';base64,';
        var base64Index = dataURI.indexOf(BASE64_MARKER) + BASE64_MARKER.length;
        var base64 = dataURI.substring(base64Index);
        var raw = window.atob(base64);
        var rawLength = raw.length;
        var array = new Uint8Array(new ArrayBuffer(rawLength));

        for(i = 0; i < rawLength; i++) {
            array[i] = raw.charCodeAt(i);
        }
        return array;
    }
    
    function readMultipleImg(evt) {
        //Retrieve all the files from the FileList object
        var files = evt.target.files; 
                
        if (files) {
            for (var i=0, f; f=files[i]; i++) {
                if ( /(jpe?g|png|gif)$/i.test(f.type) ) {
                    var r = new FileReader();
                    r.onload = (function(f) {
                        return function(e) {
                            var base64Img = e.target.result;
                            var binaryImg = convertDataURIToBinary(base64Img);
                            var blob = new Blob([binaryImg], {type: f.type});
                            var x = tampungImg.length;
                            var blobURL = window.URL.createObjectURL(blob);
                            var fileName = makeid(f.name.split('.').pop());
                            tampungImg[x] = {name:fileName, type:f.type, size:f.size, binary:Array.from(binaryImg)};
                            document.getElementById('reviewImg').innerHTML += '<img src="'+blobURL+'" data-idx="'+fileName+'" class="tmpImg" title="Hapus gambar"/>';
                        };
                    })(f);

                    r.readAsDataURL(f);
                } else { 
                    alert("Failed file type");
                }
            }
        } else {
              alert("Failed to load files"); 
        }
    }
    
    function makeid(x) {
        var d = new Date();
        var text = d.getTime();
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text+'.'+x;
    }
    
    $('body').on('click', '.tmpImg', function() {
        var k = $(this).data('idx');
        tampungImg = tampungImg.filter(function( obj ) {
            return obj.name !== k;
        });
        $(this).remove();
        return false;
    }); 
    
    // document.getElementById('fileinput').addEventListener('change', readMultipleImg, false);

}
