@if(session()->has('department_create'))
    <div id="note">
        {{session('department_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('department_edit'))
    <div id="note">
        {{session('department_edit')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('department_delete'))
    <div id="note">
        {{session('department_delete')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_time'))
    <div id="note">
        {{session('schedule_time')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_delete'))
    <div id="note">
        {{session('schedule_delete')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('department_check'))
    <div id="note">
        {{session('department_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('department_schedule_exist_check'))
    <div id="note">
        {{session('department_schedule_exist_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_create'))
    <div id="note">
        {{session('schedule_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_edit'))
    <div id="note">
        {{session('schedule_edit')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_delete'))
    <div id="note">
        {{session('schedule_delete')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('position_check'))
    <div id="note">
        {{session('position_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('position_create'))
    <div id="note">
        {{session('position_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('position_update'))
    <div id="note">
        {{session('position_update')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('position_delete'))
    <div id="note">
        {{session('position_delete')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('email_check'))
    <div id="note">
        {{session('email_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('employee_create'))
    <div id="note">
        {{session('employee_create')}}<a id="close">[close]</a>
    </div>
@endif



@if(session()->has('employee_update'))
    <div id="note">
        {{session('employee_update')}}<a id="close">[close]</a>
    </div>
@endif


@if(session()->has('employee_delete'))
    <div id="note">
        {{session('employee_delete')}}<a id="close">[close]</a>
    </div>
@endif




@if(session()->has('holiday_check'))
    <div id="note">
        {{session('holiday_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('attendance_date_check'))
    <div id="note">
        {{session('attendance_date_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('attendance_time_check'))
    <div id="note">
        {{session('attendance_time_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('attendance_create'))
    <div id="note">
        {{session('attendance_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('attendance_update'))
    <div id="note">
        {{session('attendance_update')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('schedule_empty_check'))
    <div id="note">
        {{session('schedule_empty_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('attendance_delete'))
    <div id="note">
        {{session('attendance_delete')}}<a id="close">[close]</a>
    </div>
@endif







@if(session()->has('leave_type_create'))
    <div id="note">
        {{session('leave_type_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('leave_type_update'))
    <div id="note">
        {{session('leave_type_update')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('leave_type_delete'))
    <div id="note">
        {{session('leave_type_delete')}}<a id="close">[close]</a>
    </div>
@endif






@if(session()->has('leave_date_check'))
    <div id="note">
        {{session('leave_date_check')}}<a id="close">[close]</a>
    </div>
@endif



@if(session()->has('leave_date_exist_check'))
    <div id="note">
        {{session('leave_date_exist_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('leave_year_valid_check'))
    <div id="note">
        {{session('leave_year_valid_check')}}<a id="close">[close]</a>
    </div>
@endif



@if(session()->has('attendance_date_exist_check'))
    <div id="note">
        {{session('attendance_date_exist_check')}}<a id="close">[close]</a>
    </div>
@endif


@if(session()->has('remain_day_check'))
    <div id="note">
        {{session('remain_day_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('employee_leave_create'))
    <div id="note">
        {{session('employee_leave_create')}}<a id="close">[close]</a>
    </div>
@endif


@if(session()->has('employee_leave_delete'))
    <div id="note">
        {{session('employee_leave_delete')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('employee_leave_approve'))
    <div id="note">
        {{session('employee_leave_approve')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('employee_leave_reject'))
    <div id="note">
        {{session('employee_leave_reject')}}<a id="close">[close]</a>
    </div>
@endif



@if(session()->has('employee_approve_check'))
    <div id="note">
        {{session('employee_approve_check')}}<a id="close">[close]</a>
    </div>
@endif






@if(session()->has('holiday_check'))
    <div id="note">
        {{session('holiday_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('holiday_create'))
    <div id="note">
        {{session('holiday_create')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('holiday_update'))
    <div id="note">
        {{session('holiday_update')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('holiday_delete'))
    <div id="note">
        {{session('holiday_delete')}}<a id="close">[close]</a>
    </div>
@endif


@if(session()->has('profile_edit'))
    <div id="note">
        {{session('profile_edit')}}<a id="close">[close]</a>
    </div>
@endif


@if(session()->has('attendance_report_check'))
    <div id="note">
        {{session('attendance_report_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('leave_report_check'))
    <div id="note">
        {{session('leave_report_check')}}<a id="close">[close]</a>
    </div>
@endif

@if(session()->has('yearly_attend_report_check'))
    <div id="note">
        {{session('yearly_attend_report_check')}}<a id="close">[close]</a>
    </div>
@endif