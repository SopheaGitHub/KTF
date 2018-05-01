@extends('layouts.k_app')

@section('content')
<div class="col-md-8 col-md-offset-2" id="login">
    <div class="login">
        <form id="loginform">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input class="form-control border no-shadow no-rounded" id="user-id" placeholder="user id">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Avatar</span>
                <input class="form-control border no-shadow no-rounded" id="profile" placeholder="profile" value="">
                <span class="input-group-btn">
                <button class="btn btn-primary no-rounded" type="submit">Login</button>
                </span>
            </div>
        </form>
        <div id="status">
        </div>
    </div>
</div>
@endsection