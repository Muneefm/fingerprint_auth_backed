@extends('admin.master')
@section('content')



<?php $empid = $eid;
 $emp = DB::table('users')->where('id',$empid)->first();

 ?>

                <!-- PAGE CONTENT WRAPPER -->


<div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" method="post" action="{{url('/update_emp')}}" enctype="multipart/form-data">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update</strong> Employees</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                </div>
                                <div class="panel-body">

                                @if(isset($success))
 <div style="margin-bottom: 40px" class="alert alert-success" role="alert">
                                                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <strong>Success!</strong>
                                          <p class="alert-material-red" >{{$success}}</p>


                                                                </div>
                                @endif


 @if($errors->first('email')!=null||$errors->first('username')!=null||$errors->first('password')!=null)
                                     <div class="alert alert-danger" role="alert">
                                                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <strong>Oh snap!</strong> <p class="alert-material-red" >{{ $errors->first('email')}}</p>
                                                                                                         <p class="alert-material-red" >{{ $errors->first('username')}}</p>
                                          <p class="alert-material-red" >{{ $errors->first('password')}}</p>


                                                                </div>
@endif


                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Name</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="ename" class="form-control" value="{{$emp->name}}"/>
                                                    </div>
                                                    <span class="help-block">Name of employee</span>
                                                </div>
                                            </div>


                                             <div class="form-group">
                                                                                            <label class="col-md-3 control-label">Designation</label>
                                                                                            <div class="col-md-9">
                                                                                                <div class="input-group">
                                                                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                                    <input type="text" name="edesignation" class="form-control" value="{{$emp->designation}}" />
                                                                                                </div>
                                                                                                <span class="help-block">Designation of employee</span>
                                                                                            </div>
                                                                                        </div>


                                             <div class="form-group">
                                                <label class="col-md-3 control-label">Duty</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="eduty" value="{{$emp->duty}}" />
                                                    </div>
                                                    <span class="help-block">Duty of employee</span>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Note</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <textarea class="form-control" name="enote" rows="5"  >{{$emp->note}}</textarea>
                                                    <span class="help-block">Note about employee</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="fileinput btn-primary" name="eproimg" id="proimg"  title="Browse file"/>
                                                    <span class="help-block">Image of employee</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>
                                                                                <div class="col-md-9">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon">@</span>
                                                                                        <input type="text" class="form-control" name="eemail" placeholder="E-mail" value="{{$emp->email}}" />
                                                                                    </div>
                                                                                    <span class="help-block">Employee email</span>
                                                                                </div>
                                                                            </div>




                                           <div class="form-group">
                                                                                          <label class="col-md-3 control-label">Username</label>
                                                                                          <div class="col-md-9">
                                                                                              <div class="input-group">
                                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                                  <input type="text" class="form-control" name="eusername"  value="{{$emp->username}}" />
                                                                                              </div>
                                                                                              <span class="help-block">Username for employee login</span>
                                                                                          </div>
                                                                                      </div>

                                           <div class="form-group">
                                                                                          <label class="col-md-3 control-label">Password</label>
                                                                                          <div class="col-md-9 col-xs-12">
                                                                                              <div class="input-group">
                                                                                                  <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                                                                  <input type="password" class="form-control" name="epassword" value="" />


                                                                                              </div>

                                                                                              <span class="help-block">Password for employee login</span>
                                                                                          </div>
                                                                                      </div>

                        <input type="hidden" value="{{ csrf_token()  }}" name="_token">
                        <input type="hidden" value="{{ $empid  }}" name="eid">


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Admin</label>
                                                <div class="col-md-9">
                                                    <label class="check"><input name="eadmincheck" type="checkbox" class="icheckbox"  value="1"   <?php if($emp->level == 1) {echo 'checked="true"';}  ?>   /> </label>
                                                    <span class="help-block">Set employee as super Admin</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <a href="{{url("admin_dashboard")}}" type="button" class="btn btn-default">Cancel</a>
                                    <button class="btn btn-primary pull-right">Update Employee</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->






@endsection
