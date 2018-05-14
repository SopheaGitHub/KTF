@extends('layouts.k_app')
@section('content')
<!-- content -->

<!-- rooms list -->
<a href="#" style="float: right" id="logout" class="btn btn-danger no-rounded">Logout</a>
<div class="col-md-8">
	<ul class="chat">
	</ul>
	<div class="chat-box">
		<form>
			<div class="input-group">
				<span class="input-group-addon">										
					<label class="btn btn-default btn-xs">
						<i class="fa fa-file-image-o"></i> <input type="file" id="fileinput" multiple style="display: none;">
					</label>										
				</span>
				<input id="message" type="text" data-emojiable="true" class="form-control border no-shadow no-rounded" placeholder="Type your message here">
				<span class="input-group-btn">
					<button class="btn btn-success no-rounded" id="send" type="submit">Send</button>
				</span>
			</div>
		</form>
		<div id="reviewImg"></div>
	</div>
</div>
	

@endsection