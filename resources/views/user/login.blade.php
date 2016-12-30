@extends('user.masterlogin')

@section('content')


<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class=""></div>
        <div class="login-body">
            <div style="text-align: center" class="login-title"><strong>Leave Register System </strong>Employee</div>

            <div class="login-title"><strong>Log In</strong> to your account</div>
            <!-- error  container -->
            @if($errors->first('i')!=null||$errors->first('username')!=null||$errors->first('password')!=null)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <strong>Oh snap!</strong>
                <p class="alert-material-red">{{ $errors->first('i')}}</p>
                <p class="alert-material-red">{{ $errors->first('username')}}</p>
                <p class="alert-material-red">{{ $errors->first('password')}}</p>


            </div>
            @endif


            <form action="{{url('user_login')}}" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" id="lusername" class="form-control" name="username"
                               placeholder="Your unique username"/>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" id="lpassword" class="form-control" name="password"
                               placeholder="Password"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" id="lfotp" class="form-control" name="fotp"
                               placeholder="Fingerprint OTP"/>
                    </div>
                </div>
                <input type="hidden" value="{{ csrf_token()  }}" name="_token">
                <div class="form-group">
                    <!--<div class="col-md-6">
                        <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                    </div>-->
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block">Log In</button>
                    </div>
                </div>

                <div class="login-subtitle">
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2016 Muneef.me
            </div>
            <div class="pull-right">
                <a href="muneef.me">About</a> |

            </div>
        </div>
    </div>

</div>


@endsection