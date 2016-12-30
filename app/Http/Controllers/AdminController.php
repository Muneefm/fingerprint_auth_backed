<?php namespace App\Http\Controllers;


use App\Leave;
use App\Leavetype;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\MessageBag;

class AdminController extends Controller
{

    public function __construct()
    {

    }

    function test()
    {
        return view('admin.test');
    }

    function populateUser()
    {

        $demoUser = new User();
        $demoUser->name = 'demo user';
        $demoUser->username = 'demo';
        $demoUser->level = '1';

        $demoUser->password = Hash::make('pass');
        $demoUser->save();


    }

    function checkAdmin()
    {
        if (Auth::check() && Auth::user()->level == '1') {
            return true;
        } else {
            return false;
        }
    }

    function checkUserLogin()
    {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    function redirectAdminLogin()
    {
        return Redirect('admin_login');
    }


    function adminLoginGet()
    {
        if ($this->checkAdmin()) {

            return Redirect('admin_dashboard');
        } else {
            return view('admin.adminlogin');
        }
    }

    function adminLoginPost()
    {

        $username = Input::get('username');
        $pass = Input::get('password');


        $validator = Validator::make(
            [
                'password' => Input::get('password'),
                'username' => Input::get('username')
            ],
            [
                'password' => 'required',
                'username' => 'required'
            ]
        );
        if ($validator->fails()) {
            //return 'validator fail';
            $messages = $validator->messages();
            $erUsername = $messages->first('username');
            $erPass = $messages->first('password');
            // dd($validator);
            return view('admin.adminlogin')->withErrors($validator);
            // The given data did not pass validation
        } else {


            //dd($input = Input::all());

            if (Auth::attempt([
                'username' => Input::get('username'),
                'password' => Input::get('password')

            ])
            ) {
                if (Auth::user()->level == '1') {
                    return redirect('admin_dashboard');
                } else {
                    $err1 = new MessageBag(['i' => ['Not enough permission to access admin panel']]);
                    return Redirect('admin_login')->withErrors($err1);
                }
                //return 'succes';

            } else {
                $err = new MessageBag(['i' => ['Invaid Username or Password']]);

                return Redirect::back()->withErrors($err);

            }
        }

    }


    function adminDashGet()
    {
        if ($this->checkAdmin()) {
            return view('admin.dashboard');
        } else {
            return $this->redirectAdminLogin();
        }

    }


    function userLogout()
    {
        Auth::logout();
        return Redirect('admin_login');
    }

    function addEmployee()
    {

        if ($this->checkAdmin()) {
            return view('admin.addemp');
        } else {
            return Redirect('admin_login');
        }

    }

    function addEmployeePost()
    {
        if ($this->checkAdmin()) {
            $name = Input::get();
            $validator = Validator::make(
                [
                    'name' => Input::get('name'),
                    'designation' => Input::get('designation'),
                    'duty' => Input::get('duty'),
                    'note' => Input::get('note'),
                    'email' => Input::get('email'),
                    'admin' => Input::get('admincheck'),

                    'password' => Input::get('password'),
                    'username' => Input::get('username')
                ],
                [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:3',
                    'username' => 'required|unique:users'
                ]
            );
            if ($validator->fails()) {
                //return 'validator fail';
                $messages = $validator->messages();
                $erUsername = $messages->first('username');
                $erPass = $messages->first('password');
                $erEmail = $messages->first('email');
                // dd($validator);
                return view('admin.addemp')->withErrors($validator);
                // The given data did not pass validation
            } else {

                $admin = Input::get('admincheck');
                if ($admin == null) {
                    $admin = 0;
                }

                $user = new User();
                $user->name = Input::get('name');
                $user->designation = Input::get('designation');
                $user->duty = Input::get('duty');
                $user->note = Input::get('note');
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->email = Input::get('email');
                $user->level = $admin;

                if (Input::hasFile('proimg')) {
                    $imageFile = Input::file('proimg');
                    $filename = time() . '-profile_photo' . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move('profileimg', $filename);
                    $ext = $imageFile->getClientOriginalExtension();
                    $user->image = $filename;
                }

                $user->save();
                return view('admin.addemp')->with('success', 'Employee Successfully saved');

            }
        }
    }

    function deleteEmployees()
    {
        if ($this->checkAdmin()) {
            $inputId = Input::get('id');
            if ($inputId != null) {
                // DB::table('users')->where('id', $inputId)->delete();
                $this->deleteUser($inputId);
            }
            return Redirect('admin_dashboard');
        } else {
            return $this->redirectAdminLogin();
        }
    }

    function getProfileView()
    {
        if ($this->checkAdmin()) {
            $id = Input::get('id');
            $users = DB::table('users')->where('id', $id)->first();
            return view('admin.empdetails')->with('uId', $id);
        } else {
            return $this->redirectAdminLogin();
        }
    }

    function getUpdateEmp()
    {

        if ($this->checkAdmin()) {
            $eid = Input::get('eid');
            if ($eid != null) {
                return view('admin.editemp')->with('eid', $eid);
            }
        } else {
            return $this->redirectAdminLogin();
        }
    }

    function postUpdateEmp()
    {

        if ($this->checkAdmin()) {
            $eid = Input::get('eid');
            $validator = Validator::make(
                [
                    'name' => Input::get('ename'),
                    'designation' => Input::get('edesignation'),
                    'duty' => Input::get('eduty'),
                    'note' => Input::get('enote'),
                    'email' => Input::get('eemail'),
                    'admin' => Input::get('eadmincheck'),

                    'password' => Input::get('epassword'),
                    'username' => Input::get('eusername')
                ],
                [

                    'email' => 'required|email|unique:users,email,' . $eid,
                    'password' => 'min:3',
                    'username' => 'required|unique:users,username,' . $eid
                ]
            );
            if ($validator->fails()) {
                //return 'validator fail';
                $messages = $validator->messages();
                $erUsername = $messages->first('username');
                $erPass = $messages->first('password');
                $erEmail = $messages->first('email');
                // dd($validator);
                return view('admin.addemp')->withErrors($validator);
                // The given data did not pass validation
            } else {
                $userTbl = DB::table('users')->where('id', $eid)->first();
                $admin = Input::get('eadmincheck');
                if ($admin == null) {
                    $admin = 0;
                }
                $filename = "";
                if (Input::hasFile('eproimg')) {
                    $imageFile = Input::file('eproimg');
                    if ($imageFile != null) {
                        $filename = time() . '-profile_photo' . '.' . $imageFile->getClientOriginalExtension();
                        $imageFile->move('profileimg', $filename);
                        $ext = $imageFile->getClientOriginalExtension();
                    } else {
                        // echo 'imageFile null';

                        $filename = $userTbl->image;
                    }

                } else {
                    // echo 'imageFile null';

                    $filename = $userTbl->image;
                }

                $passwd = Hash::make(Input::get('epassword'));
                if (Input::get('epassword') != null && Input::get('epassword') != "") {
                    $passwd = Hash::make(Input::get('epassword'));
                    //  DB::table('users')->where('id',$eid)->update(['remember_token'=>'']);
                } else {
                    $passwd = $userTbl->password;
                }


                $updateData = [['name' => Input::get('ename')], ['designation' => Input::get('edesignation')], ['duty' => Input::get('eduty')], ['note' => Input::get('enote')], ['email' => Input::get('eemail')], ['username' => Input::get('eusername')],
                    ['password' => Hash::make(Input::get('epassword'))], ['level' => Input::get('eadmin')], ['image' => $filename]];
                $updateDataA = ['name' => Input::get('ename'), 'designation' => Input::get('edesignation'), 'duty' => Input::get('eduty'), 'note' => Input::get('enote'), 'email' => Input::get('eemail'), 'username' => Input::get('eusername'),
                    'password' => $passwd, 'level' => Input::get('eadmin'), 'image' => $filename];
                DB::table('users')->where('id', $eid)->update($updateDataA);

                return Redirect('emp_detail?id=' . $eid);


            }
        } else {
            return $this->redirectAdminLogin();
        }
    }


    function getLeaveRequest()
    {
        if ($this->checkAdmin()) {
            return view('admin.listleaverequest');
        } else {
            return Redirect('admin_login');
        }
    }


    function getLeaveAction()
    {
        //dd(Input::get('rejreason'));
        if ($this->checkAdmin()) {
            $rejreason = Input::get('rejreason');
            $var = Input::get('var');
            if ($var == 2) {
                $id = Input::get('id');
                if ($id != null) {
                    $act = Input::get('act');
                    if ($act != null) {
                        if ($act == 1) {
                            date_default_timezone_set("Asia/Kolkata");
                            $currentDate = date("d/m/Y");
                            $currentTime = date("h:i:sa");
                            $leaveItem = DB::table('leaveapply')->where('id', $id)->first();
                            $leave = new Leave();
                            $leave->empid = $leaveItem->empid;
                            $leave->application_id = $leaveItem->id;
                            $leave->username = $leaveItem->username;
                            $leave->totalleave = $leaveItem->totalleave;
                            $leave->startdate = $leaveItem->start_date;
                            $leave->enddate = $leaveItem->end_date;
                            $leave->start_half = $leaveItem->start_half;
                            $leave->end_half = $leaveItem->end_half;
                            $leave->ondate = $currentDate;
                            $leave->ontime = $currentTime;
                            $leave->leave_type = $leaveItem->leave_type;
                            //$leave->rejreason = Input::get('rejreason');
                            $leave->save();
                            DB::table('leaveapply')->where('id', $id)->update(['status' => 1]);
                            DB::table('leaveapply')->where('id', $id)->update(['rejreason' => ""]);

                        } elseif ($act == 2) {
                            DB::table('leave')->where('application_id', $id)->delete();
                            DB::table('leaveapply')->where('id', $id)->update(['status' => 2]);
                            DB::table('leaveapply')->where('id', $id)->update(['rejreason' => $rejreason]);
                        }
                    }
                }
            }
            return Redirect('admin_leaves');
        } else {
            return Redirect('admin_login');
        }
    }


    function getEmpInfoLeaveDeatils()
    {
        if ($this->checkAdmin()) {
            $upperDates = Input::get('upper_date');
            $lowerDates = Input::get('lower_date');
            $userId = Input::get('id');
            if ($upperDates != null && $lowerDates != null && $userId != null) {

                $totalDays = 0;
                $actualLeaveDates = Array();
                $userLeavDb = DB::table('leave')->where('empid', $userId)->get();
                date_default_timezone_set("Asia/Kolkata");

                $upperDate = new \DateTime($upperDates);
                $lowerDate = new \DateTime($lowerDates);
                $lowerDate->modify('+1 day');
                $period = new \DatePeriod($upperDate, new \DateInterval('P1D'), $lowerDate);

                foreach ($userLeavDb as $userLeav) {
                    $startD = new \DateTime($userLeav->startdate);
                    $endD = new \DateTime($userLeav->enddate);
                    $endD->modify('+1 day');
                    $periodLeaveDate = new \DatePeriod($startD, new \DateInterval('P1D'), $endD);

                    foreach ($period as $date) {
                        //echo $date->format("d-m-Y") . "";
                        foreach ($periodLeaveDate as $datel) {
                            // echo $datel->format("d-m-Y") . "  ";
                            if ($date->format("d-m-Y") == $datel->format("d-m-Y")) {
                                $actualLeaveDates[] = $date->format("Y-m-d") . "";
                                // echo "equal ".$date->format("d-m-Y");
                                $totalDays++;
                            }
                        }
                    }
                }
                //    echo $totalDays."  = days";
                //    dd($actualLeaveDates);

                return view('admin.empdetails')->with('total_days', $totalDays)->with('leaveDates', $actualLeaveDates)->with('uId', $userId);


            }


        } else {
            return Redirect('admin_login');
        }

    }

    function getPref()
    {
        if ($this->checkAdmin()) {
            //echo 'sdfdsfsdfsd';
            return view('admin.pref');

        } else {
            return Redirect('admin_login');
        }

    }

    function postAddLtype()
    {
        if ($this->checkAdmin()) {
            $lid = Input::get('lid');
            $lname = Input::get('lname');
            $llimit = Input::get('llimit');
            if ($lid != null && $lname != null) {

                $validator = Validator::make(
                    [
                        'lid' => Input::get('lid'),
                        'name' => Input::get('lname'),
                        'limit' => Input::get('llimit')

                    ],
                    [

                        'lid' => 'required|integer|unique:leavetype',
                        'name' => 'required',
                        'limit' => 'integer'


                    ]
                );

                if ($validator->fails()) {

                    $messages = $validator->messages();
                    $erLid = $messages->first('lid');
                    $erName = $messages->first('name');
                    $erLimit = $messages->first('limit');
                    // dd($validator);
                    return view('admin.pref')->withErrors($validator);
                    // The given data did not pass validation
                } else {
                    if ($llimit == null || $llimit == 0) {
                        $isLimit = 0;
                    } else {
                        $isLimit = 1;
                    }


                    $type = new Leavetype();
                    $type->lid = $lid;
                    $type->name = $lname;
                    $type->limit = $llimit;
                    $type->islimit = $isLimit;
                    $type->save();

                    return Redirect('admin_pref');
                }

            }


        } else {
            return Redirect('admin_login');

        }
    }




    function getDeleteLType(){
        if($this->checkAdmin()){
            $id = Input::get('id');
            if($id!=null){
                $this->deleteLeaveType($id);
            }
            return Redirect('admin_pref');
        }else{
            return Redirect('admin_login');

        }
    }


    function postUpdateLeaveLimit(){
        if($this->checkAdmin()){

            $id = Input::get('id');
            $lmt = Input::get('lval');

            if($id !=null){
                DB::table('leavetype')->where('id',$id)->update(['limit'=>$lmt]);
            }
            return Redirect('admin_pref');

            }else{
            return Redirect('admin_login');

        }


        }





    // functions
    function getDeleteLeaveApplication()
    {
        $appId = Input::get('id');

        if ($this->checkAdmin()) {

            if ($appId != null) {
                $this->deleteLeaveApplication($appId);
            }
            return Redirect('admin_leaves');
        } else if ($this->checkUserLogin()) {
            $this->deleteLeaveApplication($appId);
            return Redirect('user_dash');

        } else {
            return Redirect('user_login');
        }
    }


    public static function calculateTotalLeave($userId)
    {
        // $userId ='1';
        $totalDaysYear = 0;
        $actualLeaveDates = Array();
        $userLeavDb = DB::table('leave')->where('empid', $userId)->get();
        date_default_timezone_set("Asia/Kolkata");
        $dateStringUp = '01-01-' . date('Y');
        $todayDate = date('d-m-Y');

        $upperDate = new \DateTime($dateStringUp);
        $lowerDate = new \DateTime($todayDate);
        $lowerDate->modify('+1 day');
        $period = new \DatePeriod($upperDate, new \DateInterval('P1D'), $lowerDate);

        foreach ($userLeavDb as $userLeav) {
            $startD = new \DateTime($userLeav->startdate);
            $endD = new \DateTime($userLeav->enddate);
            $endD->modify('+1 day');
            $periodLeaveDate = new \DatePeriod($startD, new \DateInterval('P1D'), $endD);

            foreach ($period as $date) {
                //echo $date->format("d-m-Y") . "";
                foreach ($periodLeaveDate as $datel) {
                    // echo $datel->format("d-m-Y") . "  ";
                    if ($date->format("d-m-Y") == $datel->format("d-m-Y")) {
                        $actualLeaveDatesinYear[] = $date->format("Y-m-d") . "";
                        // echo "equal ".$date->format("d-m-Y");
                        $totalDaysYear++;
                    }
                }
            }
        }
        return $totalDaysYear;

    }


    function deleteUser($userId)
    {
        if ($this->checkAdmin()) {

            DB::table('leave')->where('empid', $userId)->delete();
            DB::table('leaveapply')->where('empid', $userId)->delete();
            DB::table('users')->where('id', $userId)->delete();
            return true;


        } else {
            return Redirect('admin_login');


        }

    }

    function deleteLeaveApplication($applicationId)
    {

        if ($this->checkAdmin()) {
            DB::table('leaveapply')->where('id', $applicationId)->delete();
            return true;
        } else if ($this->checkUserLogin()) {
            $lItem = DB::table('leaveapply')->where('id', $applicationId)->first();
            if ($lItem->empid == \Illuminate\Support\Facades\Auth::user()->id&&$lItem->status=='0') {
                DB::table('leaveapply')->where('id', $applicationId)->delete();
            }


            return true;

        } else {
            return Redirect('user_login');

        }

    }
    function deleteLeaveType($id){
        if($this->checkAdmin()){
            DB::table('leavetype')->where('id', $id)->delete();

        }
    }

    public static function getLeaveTypeName($id){

        return DB::table('leavetype')->where('lid',$id)->first()->name;
    }


}