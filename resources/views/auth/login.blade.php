@extends('layouts.k_app')

@section('content')
<div class="panel panel-success">
    <div class="panel-heading">
        <ol class="breadcrumb">
            <li><a href="home.php" style="font-size:18px;"><i class="fa fa-arrow-circle-left" aria-hidden="true" title="Go to home page"></i></a></li>
            <li><a href="home.php">Home</a></li>
            <li class="active">Login</li>
        </ol>
    </div>
    <div class="panel-body">
        <em>Welcome ... Happy to see you again.</em>
        <br /><hr />
        <div class="row">
            <div class="col-md-4">
                 <form class="form-horizontal" method="POST" action="<?php echo route('login'); ?>">
                        {{ csrf_field() }}


                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="" class="col-sm-5 control-label">Phone Number Or Email</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control"  placeholder="Phone Number Or Email" name="username" />
                       @if ($errors->has('username'))
                            <span class="help-block">
                            <?php
                                $search  = ['The username field is required.'];
                                $replace = [trans('auth.email_required')];
                                echo '<strong>'.str_replace($search, $replace, $errors->first('username')).'</strong>';
                            ?>
                            </span>                            
                        @endif
                    </div>
                    </div>

                    <!-- These credentials do not match our records. -->


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="" class="col-sm-5 control-label">Password</label>
                    <div class="col-sm-7">
                    <input type="password" class="form-control"  placeholder="Password" name="password"/>
                       @if ($errors->has('password'))
                            <span class="help-block">
                                <?php
                                    $search  = ['The password field is required.'];
                                    $replace = [trans('auth.password_required')];
                                    echo '<strong>'.str_replace($search, $replace, $errors->first('password')).'</strong>';
                                ?>
                            </span>
                        @endif
                    </div>

                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                        <a href="">Forgot your password?</a>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                      <button type="submit" class="btn btn-success">Log in</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-right">
                Or Login With
                <div><a href="#" class="btn btn-primary" style="width:50%; margin:5px;"><i class="fa fa-facebook"></i>acebook</a></div>
                <div><a href="#" class="btn btn-danger" style="width:50%; margin:5px;"><i class="fa fa-google"></i>oogle</a></div>
                <br /><br />
            </div>
            <div class="col-md-4">
                Don’t have an account? <a href="<?php echo URL::to('/register'); ?>">Join Us</a>
            </div>
        </div>
    </div>
</div>
@endsection
