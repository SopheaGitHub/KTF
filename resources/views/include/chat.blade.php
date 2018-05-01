<!--- chat room -->
<div class="popup-box chat-popup" id="chatroom" style="right: 270px; display: block;">
  <div class="popup-head">
    <div class="popup-head-left" id="chatroom-popup-head-left">AAA</div>
    <div class="popup-head-right">
      <a href="#" onclick="document.getElementById('chatroom').style.display = 'none';">&#10005;</a>
    </div>
    <div style="clear: both"></div>
  </div>

  <ul class="chat" style="margin:0px; padding:5px;">
  </ul>

  <form>
  <div class="chat-box" style="padding:3px; ">
    <div class="col-md-10" style="padding:0px;">
      <textarea class="form-control no-shadow no-rounded" id="message" placeholder="Your text here ..." style="font-size:11px; min-height:40px;max-height:40px;min-width:100%;max-width:100%;"></textarea>
    </div>
    <div class="col-md-2" style="padding:0px;">
      <div class="text-right"><button class="btn btn-success btn-xs no-rounded" id="sendchat" type="submit">Send</button></div>
    </div>
  </div>
  </form>
</div>

<!--- chat list -->
<div class="row chat-window col-xs-5 col-md-3" id="chat_window_1">
  <div class="col-xs-12 col-md-12" style="padding-right: 0px;">
    <div class="panel panel-success" style="margin:0px;">
      <div class="panel-heading top-bar" style="background: #5cb85c; color:#ffffff;">
          <div class="row">
            <div class="col-md-8 col-xs-8">
              <h4 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat</h4>
            </div>
            <div class="col-md-4 col-xs-4" style="text-align: right;">
                <span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim" style="color:#ffffff; cursor:pointer;"></span>
            </div>
          </div>
      </div>
      <div class="panel-body msg_container_base">

        <div id="avatarlogin"></div>
        <ul class="users-list"></ul>

      </div>
      <!-- <div class="panel-footer" style="background-color: #f5f8fa;">
          <input id="btn-input iconified" type="text" class="form-control input-sm chat_input search" placeholder="&#xF002; Search ..." />
      </div> -->
    </div>
  </div>
</div>

