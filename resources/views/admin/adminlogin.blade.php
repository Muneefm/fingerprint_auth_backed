@extends('admin.masterlogin')

 @section('content')





<div class="login-container">

            <div class="login-box animated fadeInDown">
             @if($errors->first('i')!=null||$errors->first('username')!=null||$errors->first('password')!=null)
                                                 <div class="alert alert-danger" role="alert">
                                                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                <strong>Oh snap!</strong> <p class="alert-material-red" >{{ $errors->first('i')}}</p>
                                                                                                                     <p class="alert-material-red" >{{ $errors->first('username')}}</p>
                                                      <p class="alert-material-red" >{{ $errors->first('password')}}</p>

                                                      @endif

                <div class="login-body">

                    <div class="login-title"><strong>Leave system admin portal</strong>, Please login</div>
                    <form action="{{url('admin_login')}}" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="username" class="form-control" placeholder="Username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                                            <input type="hidden" value="{{ csrf_token()  }}" name="_token">

                        <div class="col-md-6">
                            <a href="{{url('user_login')}}" class="btn btn-link btn-block">Login as an Employee?</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Leave Application
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>


@endsection


