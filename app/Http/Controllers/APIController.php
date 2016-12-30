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

class APIController extends Controller
{
    public function __construct() {
        $this->beforeFilter('csrf', ['on' => '']);
    }

    function checkEMI(){
        $isuserexist =0;
        $message = "Error";
        $status =0;
        $otp='';

        $emi =  Input::get('emi');
        if($emi!=null){
        $dbUser = DB::table('users')->where('emi', $emi)->first();
        if($dbUser!=null){
            $isuserexist =1;
            $message = "EMI exist";
            $status =1;
            $otp =rand(1000,9999);
            DB::table('users')->where('emi', $emi)->update(['otp'=>$otp]);
        }else{
            $isuserexist =0;
            $message = "EMI does not exist";
            $status =2;

        }
        }

        return json_encode(['isuser'=>$isuserexist,'message'=>$message,'status'=>$status,'otp'=>$otp.'' ]);

    }

    function postRegisterId()
    {

            $username = Input::get('username');
            $password = Input::get('pass');
            $emi = Input::get('emi');
            $msg = 'null values';
            $status=0;
            $otp='';
            if($username!=null&&$password!=null&&$emi!=null){

            if(\Illuminate\Support\Facades\Auth::attempt([
                'username' => $username,
                'password' => $password

            ])){

                $status =1;
                $otp =rand(1000,9999);

            DB::table('users')->where('username',$username)->update(['emi'=>$emi]);
                DB::table('users')->where('emi', $emi)->update(['otp'=>$otp]);

                $msg = 'Success';

            }else{
                $status =2;
                $msg = 'Authentication failed';
            }
                }

                return json_encode(['status'=>$status,'message'=>$msg,'otp'=>$otp.'']);
        }

        function revokeDevice(){
        $emi = Input::get('emi');
        $status =0;
        $msg="null values";
        if ($emi!=null){
            DB::table('users')->where('emi', $emi)->update(['otp'=>'','emi'=>'']);
            $status =1;
            $msg ="Device revoked";
        }

        return json_encode(['status'=>$status,'message'=>$msg]);
        }


}