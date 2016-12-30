@extends('admin.master')
@section('content')


    <?php
    $leaveTypeDb = DB::table('leavetype')->get();
    function inflatePreference(){
    //$model = new \App\Leavetype();
    }
    ?>


    <!-- START CONTEXTUAL CLASSES TABLE SAMPLE -->
    <div class="panel panel-default">
      @if($errors->first('i')!=null||$errors->first('lid')!=null||$errors->first('name')!=null||$errors->first('limit')!=null)
          <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Oh snap!</strong> <p class="alert-material-red" >{{ $errors->first('i')}}</p>
              <p class="alert-material-red" >{{ $errors->first('lid')}}</p>
              <p class="alert-material-red" >{{ $errors->first('name')}}</p>
              <p class="alert-material-red" >{{ $errors->first('limit')}}</p>
               </div>
          @endif
        <div class="panel-heading">

            <h3 class="panel-title">Leave Types</h3>
        </div>
        <div class="panel-body">

            <!--   <p>There available 5 classes: <code>active, success, info, warning, danger</code>. Add it to TR tag.</p> -->

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Leave Name</th>
                    <th>Current Leave Limit</th>
                    <th>Action</th>
                    <th>Delete</th>


                </tr>
                </thead>
                <tbody>
                @foreach($leaveTypeDb as $leaveItem)



                    <tr class="active">
                        <td>{{$leaveItem->lid}}</td>
                        <td>{{$leaveItem->name}}</td>
                        <td>{{$leaveItem->limit}}</td>
                        <td><form method="post" action="{{url('/updt_pref')}}"> <input type="text" name="lval" class="form-control" value=""/>
                                <input type="hidden" name="id" class="form-control" value="{{$leaveItem->id}}"/>
                                <input type="hidden" value="{{ csrf_token()  }}" name="_token">

                                <button  type="submit" class="btn btn-info">Update limit</button></form></td>

                        <td><a href="{{url('/del_pref?id='.$leaveItem->id)}}" type="button" class="btn btn-danger">Delete Leave type</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- END CONTEXTUAL CLASSES TABLE SAMPLE -->
    <form class="form-horizontal" id="jvalidate" method="post" action="{{url('/add_ltype')}}" enctype="multipart/form-data">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add new Leave Type</h3>
            </div>

            <div class="row">
                <div class="col-md-3" style="margin-top: 20px">

                    <div class="form-group">
                        <label class="col-md-6 control-label">Leave ID</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="lid" class="validate[required,custom[integer]] form-control"/>
                            </div>
                            <span class="help-block">in numericals</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3" style="margin-top: 20px">


                    <div class="form-group">
                        <label class="col-md-6 control-label">Leave Type Name</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="lname" class="validate[required] form-control"/>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>

                <div class="col-md-3" style="margin-top: 20px">

                    <div class="form-group">
                        <label class="col-md-6 control-label">Limit (Days)</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input placeholder="( optional )" type="text" class="validate[required,custom[integer]] form-control" name="llimit"/>
                            </div>
                            <span class="help-block">in numericals</span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ csrf_token()  }}" name="_token">

            <div class="row">

                <div class="col-md-3"><button style="margin-top: 20px;margin-bottom: 20px" class="btn btn-primary pull-center">Add Leave Type</button></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>


            </div>

        </div>

    </form>
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>

        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>

        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS -->
        <script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    lid: {
                        required: true,

                    },
                    lname: {
                        required: true,

                    },
                    're-password': {
                        required: true,
                        minlength: 5,
                        maxlength: 10,
                        equalTo: "#password2"
                    },
                    llimit: {
                        required: true,

                    },
                    email: {
                        required: true,
                        email: true
                    },
                    date: {
                        required: true,
                        date: true
                    },
                    credit: {
                        required: true,
                        creditcard: true
                    },
                    site: {
                        required: true,
                        url: true
                    }
                }
            });

        </script>
@endsection
