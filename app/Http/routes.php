<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');



//Admin Routes
Route::get('/admin_login', 'AdminController@adminLoginGet');
Route::post('/admin_login', 'AdminController@adminLoginPost');
Route::get('/',  function (){
    return Redirect('/admin_login');
});
Route::get('/admin_logout', 'AdminController@userLogout');


Route::get('/admin_dashboard', 'AdminController@adminDashGet');
Route::get('/add_emp', 'AdminController@addEmployee');
Route::post('/add_emp', 'AdminController@addEmployeePost');
Route::get('/emp_del', 'AdminController@deleteEmployees');
Route::get('/emp_detail', 'AdminController@getProfileView');
Route::post('/emp_detail', 'AdminController@getEmpInfoLeaveDeatils');



Route::get('/update_emp', 'AdminController@getUpdateEmp');
Route::post('/update_emp', 'AdminController@postUpdateEmp');

Route::get('/admin_leaves', 'AdminController@getLeaveRequest');
Route::get('/leave', 'AdminController@getLeaveAction');
Route::post('/leave', 'AdminController@getLeaveAction');
Route::get('/del_leave', 'AdminController@getDeleteLeaveApplication');



Route::get('/admin_pref', 'AdminController@getPref');
Route::post('/add_ltype', 'AdminController@postAddLtype');
Route::get('/del_pref', 'AdminController@getDeleteLType');
Route::post('/updt_pref', 'AdminController@postUpdateLeaveLimit');






Route::get('/popuser', 'AdminController@populateUser');

Route::get('/test','AdminController@test');



//user routes


Route::get('/user_login','UserController@getLoginPage');
Route::post('/user_login','UserController@loginPost');
Route::get('/logout','UserController@userLogout');


Route::get('/user_dash','UserController@getDashUser');
Route::get('/request_leave','UserController@getLeaveReq');


Route::post('/request_leave','UserController@postLeaveReq');

Route::get('/profile','UserController@getProfile');
Route::post('/profile','UserController@postProfileLeaveDates');



Route::get('/test','AdminController@test');



//API
Route::get('/checkemi','APIController@checkEMI');
Route::post('/regf','APIController@postRegisterId');
Route::get('/revd','APIController@revokeDevice');







Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
