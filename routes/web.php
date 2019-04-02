<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Attendance;
use App\Employee;

Route::get('/', function () {
    return view('welcome');
})->name('welcome_page');

Auth::routes();


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.postLogin');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::resource('/department', 'DepartmentController');
    Route::resource('/schedule', 'ScheduleController');
    Route::resource('/position', 'PositionController');
    Route::resource('/employee', 'EmployeeController');
    Route::resource('/leave_type', 'LeaveTypeController');
    Route::get('/holiday/view', 'HolidayController@admin_calendar')->name('admin.calendar');
    Route::resource('/holiday', 'HolidayController');
    Route::get('/attendance/view_and_edit/{attendance}', 'AttendanceController@viewandedit')->name('attendance.view_and_edit');
    Route::get('/attendance/search', 'AttendanceController@search')->name('admin.attendance.search');
    Route::post('/attendance/fetch', 'AttendanceController@fetch')->name('admin.attendance.fetch');
    Route::resource('/attendance', 'AttendanceController');
    Route::get('/employee_leave/view_and_edit/{employee_leave}', 'EmployeeLeaveController@viewandedit')->name('leave.view_and_edit');
    Route::post('/employee_leave/view_and_edit/approve/{employee_leave}', 'EmployeeLeaveController@approve');
    Route::post('/employee_leave/view_and_edit/reject/{employee_leave}', 'EmployeeLeaveController@reject');
    Route::get('/employeeleave/search', 'EmployeeLeaveController@search')->name('admin.leave.search');
    Route::post('/employeeleave/fetch', 'EmployeeLeaveController@fetch')->name('admin.leave.fetch');
    Route::resource('/employeeleave', 'EmployeeLeaveController');

    Route::post('/report/download/attendance', 'ReportController@downloadAttendance')->name('download.attendance');
    Route::post('/report/download/leave', 'ReportController@downloadLeave')->name('download.leave');
    Route::post('/report/download/yearly', 'ReportController@downloadYearlyAttend')->name('download.year');;
    Route::resource('/report', 'ReportController');
});


Route::group(['prefix' => 'employee'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
    Route::get('/attendance', 'EmployeeAttendanceViewController@index')->name('employee.attendance');
    Route::get('/attendance/search', 'EmployeeAttendanceViewController@search')->name('employee.attendance.search');
    Route::get('/leave', 'EmployeeLeaveViewController@index')->name('employee.leave');
    Route::get('/leave/create', 'EmployeeLeaveViewController@create')->name('leave.employee.create');
    Route::post('/leave/store', 'EmployeeLeaveViewController@store')->name('leave.employee.store');



    Route::get('/holiday/view', 'EmployeeHolidayViewController@employee_calendar')->name('employee.calendar');
    Route::get('/profile/', 'EmployeeProfileController@index')->name('employee.profile');
    Route::post('/profile/update/{employee_profile}', 'EmployeeProfileController@update')->name('employee.profile.update');
});





