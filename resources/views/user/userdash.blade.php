@extends('user.usermaster')

 @section('content')



<?php
$iid = \Illuminate\Support\Facades\Auth::user()->id;
 $leavereqDb  = DB::table('leaveapply')->where('empid',$iid)->get();
 $leavereqDb = array_reverse($leavereqDb);

 ?>

<div class="page-content-wrap">


 <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Your Leave Request</h3>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">id</th>
                                                    <th width="100">Name</th>
                                                    <th width="100">Number</th>
                                                    <th width="100">Leave Type</th>
                                                    <th width="100">Reason</th>
                                                    <th width="100">Start Date</th>
                                                    <th width="100">End Date</th>
                                                    <th width="100">Total Days</th>
                                                    <th width="100">Status</th>
                                                    <th width="100">Reason</th>
                                                    <th width="100">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leavereqDb as $leaveObj)
                                            <?php
                                            $stat = $leaveObj->status;
                                            /* $statusString  = 'Status';
                                             if($leaveObj->status == 0 ){
                                            $statusString = 'Pending';
                                            }else if($leaveObj->status == 1){
                                            $statusString = 'Aproved';
                                            }else if($leaveObj == 2){
                                            $statusString = 'Rejected';
                                            }*/
                                             ?>
                                                <tr id="trow_1">
                                                    <td class="text-center">1</td>
                                                    <td><strong>{{$leaveObj->name}}</strong></td>
                                                     <td>{{$leaveObj->number}}</td>
                                                      <td>{{\App\Http\Controllers\AdminController::getLeaveTypeName($leaveObj->leave_type)}}</td>
                                                      <td>{{$leaveObj->reason}}</td>
                                                      <td>{{$leaveObj->start_date}}</td>
                                                      <td>{{$leaveObj->end_date}}</td>
                                                      <td>{{$leaveObj->totalleave}}</td>
                                                      @if($stat== 0)
                                                    <td><span class="label label-warning">Pending</span></td>
                                                    @elseif($stat == 1)
                                                     <td><span class="label label-success">Approved</span></td>
                                                     @elseif($stat == 2)
                                                      <td><span class="label label-danger">Rejected</span></td>
                                                      @endif
                                                    <td>{{$leaveObj->rejreason}}</td>
                                                    @if($stat == 0)
                                                    <td><a href="{{url('/del_leave?id='.$leaveObj->id)}}" onclick="return confirm('Do you really want Delete this Leave Application?');" type="button" class="btn btn-danger">Delete</a>
                                                    </td>@endif


                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->
</div>

@endsection