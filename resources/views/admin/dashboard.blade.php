@extends('admin.master')

 @section('content')


<?php
  use Illuminate\Support\Facades\Redirect;

 ?>

<!-- START BREADCRUMB -->

                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Employees</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
             <!--   <div class="page-content-wrap">


<!-- START RESPONSIVE TABLES -->

                    <!-- END RESPONSIVE TABLES -->

                <!-- END PAGE CONTENT WRAPPER -->
          <!--      </div>
            </div>
            <!-- END PAGE CONTENT -->
            <?php $users = DB::table('users')->get();
             ?>
            <div class="page-content-wrap">

                                <div class="row">
                                    <div class="col-md-12">

                                        <!-- START DEFAULT DATATABLE -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Employee List</h3>
                                                <ul class="panel-controls">
                                                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Designation</th>
                                                            <th>Duty</th>
                                                            <th>Total Leave</th>
                                                            <th>Actions</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                    <?php    $leavDb = DB::table('leave')->where('empid',$user->id)->first();
                                                 //  echo ($user->designation." this is taiol");
                                                    //exit();
                                                    ?>
                                                   <tr>
                                                    <td>{{$user->name}}</td>
                                                   <td>{{$user->designation}}</td>
                                                    <td>{{$user->duty}}</td>
                                                   <td><?php echo \App\Http\Controllers\AdminController::calculateTotalLeave($user->id);
                                                       //if($leavDb!=null){if($leavDb->totalleave!=null){echo $leavDb->totalleave;}}  ?></td>
                                                   <td> <a href="{{url('/emp_detail?id='.$user->id)}}" type="button" class="btn btn-info">Info</a>
                                                                                               <a href="{{url('/update_emp?eid='.$user->id)}}"  type="button" class="btn btn-warning">Edit</a>
                                                                                               <a href="{{url('/emp_del?id='.$user->id)}}" onclick="return confirm('Do you really want Delete this user?');"  type="button" class="btn btn-danger">Delete</a></td>

                                                  </tr>
                                                  @endforeach




                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- END DEFAULT DATATABLE -->



                                    </div>
                                </div>

                            </div>
                            <!-- PAGE CONTENT WRAPPER -->
        </div>








 @endsection