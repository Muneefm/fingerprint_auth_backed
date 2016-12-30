@extends('admin.master')
@section('content')


<?php

//include ''


if(isset($uId)){
    $userObj = DB::table('users')->where('id',$uId)->first();
    $leavDb =  DB::table('leave')->where('empid',$userObj->id)->first();
    $userId = $userObj->id;
    $totalLeav = 0;
    if($leavDb!=null){
        $totalLeav = $leavDb->totalleave;
    }
}else{

}
?>



<?php
//echo 'total leav = '.\App\Http\Controllers\AdminController::calculateTotalLeave($userId);
   //   echo  \App\Http\Controllers\AdminController::testOne();
/*
$totalDaysYear = 0;
$actualLeaveDates = Array();
$userLeavDb = DB::table('leave')->where('empid',$userId)->get();
//dd($userLeavDb);
date_default_timezone_set("Asia/Kolkata");
$dateStringUp = '01-01-'.date('Y');
$todayDate = date('d-m-Y');
$upperDate = new DateTime($dateStringUp);
$lowerDate = new DateTime($todayDate);
$lowerDate->modify('+1 day');
$period = new DatePeriod($upperDate,new DateInterval('P1D'),$lowerDate);

foreach($userLeavDb as $userLeav){
    $startD = new DateTime($userLeav->startdate);
    $endD = new DateTime($userLeav->enddate);
    $endD->modify('+1 day');
    $periodLeaveDate = new DatePeriod( $startD,new DateInterval('P1D'),$endD);

    foreach($period as $date){
        //echo $date->format("d-m-Y") . "";
        foreach($periodLeaveDate as $datel){
            // echo $datel->format("d-m-Y") . "  ";
            if($date->format("d-m-Y")==$datel->format("d-m-Y")){
                $actualLeaveDatesinYear[] =$date->format("Y-m-d")."";
                // echo "equal ".$date->format("d-m-Y");
                $totalDaysYear++;
            }
        }
    }
}
//echo $totalDaysYear."  = days"
*/


?>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-5">

            <div class="panel panel-default">
                <div  class="panel-body profile" style=" padding-top: 100px; background: #ffffff ">
                    <div class="profile-image">
                        <img style="width: 180px;height: 180px" src="profileimg/{{$userObj->image}}" alt="{{$userObj->username}}"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"  style="color: #002240;">{{$userObj->name}}</div>
                        <div class="profile-data-title" style="color: #002240;">{{$userObj->designation}}</div>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{url('/update_emp?eid='.$userId)}}" >  <button  class="btn btn-info btn-rounded btn-block"><span class="fa fa-edit"></span> Edit</button> </a>

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-window-close"></span> Delete</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body list-group border-bottom">
                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> General Info</a>
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Username <span class="badge badge-danger">{{$userObj->username}}</span></a>
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Email <span class="badge badge-danger">{{$userObj->email}}</span></a>
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Total Leave in this Year <span class="badge badge-danger">{{\App\Http\Controllers\AdminController::calculateTotalLeave($userId)}}</span></a>
                    <a href="#" class="list-group-item"><span class="fa fa-folder"></span> Duty<span class="badge badge-danger">{{$userObj->duty}}</span></a>
                </div>
                <div class="panel-body list-group border-bottom">
                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Leave Details</a>
                    <?php $dbLeaveTypes = DB::table('leavetype')->get();?>
                    @foreach($dbLeaveTypes as $itemLtype)
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> {{$itemLtype->name}} <span class="badge badge-danger">{{\App\Http\Controllers\UserController::getEachLeaveCount($uId,$itemLtype->lid)}}</span></a>
                    @endforeach
                </div>

            </div>

        </div>

        <div style="margin-top: 20px" class="col-md-5">
            <div style="margin-bottom: 30px" class="panel-heading">
                <h3 class="panel-title">Employees Leave Dates</h3>
            </div>
            <!-- START TIMELINE -->
            <form class="form-horizontal" method="post" action="{{url('/emp_detail?id='.$userId)}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-md-5 control-label">Start Date</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input name="upper_date" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" value="" data-date-viewmode="years">
                                </div>
                                <!-- <span class="help-block">Leave starting date </span> -->
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-5 control-label ">End Date</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input name="lower_date" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" value="" data-date-viewmode="years">
                                </div>
                                <!-- <span class="help-block">Leave starting date </span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ csrf_token()  }}" name="_token">

                <button style="margin-top: 20px" class="btn btn-primary ">Apply</button>

            </form>


            <!-- START CONTENT FRAME BODY -->

            @if(isset($uId)&&isset($total_days)&&isset($leaveDates))

            <div  style="margin-top: 50px" class="content-frame-body padding-bottom-0">

                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-bottom: 15px" class="calendar">
                            <div id="calendar"></div>
                        </div>
                        <h1 class="panel-title">Total Days: {{$total_days}}</h1>

                    </div>
                </div>


            </div>
            <!-- END CONTENT FRAME BODY -->

            @endif

            <!-- END TIMELINE -->

        </div>

    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->



<!-- START PLUGINS -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END THIS PAGE PLUGINS-->
<!-- END PLUGINS -->
@if(isset($uId)&&isset($total_days)&&isset($leaveDates))

<script>
    var dates = <?php echo json_encode($leaveDates); ?>;

    console.log(dates);
    var events = [];


    for(var i =0; i < dates.length; i++) {
        events.push( {title: 'leave' , start: dates[i]});
        console.log('date = '+dates[i]);
    }

    console.log(events[0]);

    $(document).ready(function() {
// alert("hello");

        console.log('inside document ready');
        $('#calendar').fullCalendar({

            defaultDate: events[0].start,
            //   defaultView: 'agendaWeek',
            events: events
        });
    });

    /*
     dayRender: function(date, cell){
     if (dates[1] > maxDate){
     $(cell).addClass('disabled');
     }
     }*/

</script>
@endif
@endsection