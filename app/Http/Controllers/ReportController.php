<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use mysql_xdevapi\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_year = date('Y');
        $range = range($current_year, $current_year - 11);



        $departments = Department::pluck('name', 'id')->all();


        return view('report.index', compact('departments', 'range'));
    }


    public function downloadAttendance(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'attendance_days' => 'required',
        ]);


        $department_id = $request->department_id;
        $attendance_days = $request->attendance_days;

        $sign_position = strpos($attendance_days, '~');
        $start_date = substr($attendance_days, 0, $sign_position);
        $end_date = substr($attendance_days, $sign_position + 1);


        $attendance_data = DB::table('employees')
            ->join('departments', function ($join) use ($department_id) {
                $join->on('employees.department_id', '=', 'departments.id')->where('employees.department_id', '=', $department_id);
            })
            ->join('attendances', function ($join) use ($start_date, $end_date) {
                $join->on('employees.id', '=', 'attendances.employee_id')->whereBetween('attendances.date', [$start_date, $end_date]);
            })
            ->select('employees.name', 'attendances.date', 'attendances.time_in', 'attendances.time_out', 'attendances.overtime_hour', 'attendances.undertime_hour')
            ->get();

        if (count($attendance_data) > 0) {
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();


            $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:F2');

            $sheet->setCellValue('A1', 'Weekly Employee Attendance Report');
            $sheet->setCellValue('A2', 'Report Date Range between ' . $start_date . " and " . $end_date);

            $sheet->setCellValue('A3', 'Name');
            $sheet->setCellValue('B3', 'Attendance Date');
            $sheet->setCellValue('C3', 'Time In');
            $sheet->setCellValue('D3', 'Time Out');
            $sheet->setCellValue('E3', 'Overtime Hour');
            $sheet->setCellValue('F3', 'Undertime Hour');


            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $styleArray = array(

                'font' => array(
                    'bold' => true,
                    'name' => 'Calibri',
                    'size' => 12,
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                ),
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '3333FF',
                    ),

                ),
            );

            $styleArray2 = array(


                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

            );

            $sheet->getStyle('A:B')->applyFromArray($styleArray2);
            $sheet->getStyle('C:D')->applyFromArray($styleArray2);
            $sheet->getStyle('E:F')->applyFromArray($styleArray2);

            $sheet->getStyle('A1')->applyFromArray($styleArray);
            $sheet->getStyle('A2')->applyFromArray($styleArray);
            $sheet->getStyle('A3:B3')->applyFromArray($styleArray);
            $sheet->getStyle('C3:D3')->applyFromArray($styleArray);
            $sheet->getStyle('E3:F3')->applyFromArray($styleArray);


            $rows = 4;
            foreach ($attendance_data as $data) {
                $sheet->setCellValue('A' . $rows, $data->name);
                $sheet->setCellValue('B' . $rows, $data->date);
                $sheet->setCellValue('C' . $rows, $data->time_in);
                $sheet->setCellValue('D' . $rows, $data->time_out);
                $sheet->setCellValue('E' . $rows, $data->overtime_hour);
                $sheet->setCellValue('F' . $rows, $data->undertime_hour);
                $rows++;
            }


            $fileName = 'Weekly Employee Attendance Report.xlsx';

            $writer = new Xlsx($spreadsheet);
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        } else {
            session()->flash('attendance_report_check', 'There are no employee attendance data for selected week');
            return back();
        }


    }

    public function downloadLeave(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'leave_days' => 'required',
        ]);

        $department_id = $request->department_id;
        $leave_days = $request->leave_days;

        $sign_position = strpos($leave_days, '~');
        $start_date = substr($leave_days, 0, $sign_position);
        $end_date = substr($leave_days, $sign_position + 1);
        $leave_data = DB::table('employee_leaves')
            ->join('employees', 'employee_leaves.employee_id', '=', 'employees.id')
            ->where('employee_leaves.leave_status', '=', 'Approve')
            ->whereBetween('employee_leaves.start_date', [$start_date, $end_date])
            ->whereBetween('employee_leaves.end_date', [$start_date, $end_date])
            ->join('departments', function ($join) use ($department_id) {
                $join->on('employees.department_id', '=', 'departments.id')->where('departments.id', $department_id);
            })
            ->select('employees.name as employee_name', 'departments.name as department_name', 'employee_leaves.start_date', 'employee_leaves.end_date', 'employee_leaves.submit_date', 'employee_leaves.leave_status')
            ->get();


        if (count($leave_data) > 0) {
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();


            $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:F2');

            $sheet->setCellValue('A1', 'Weekly Employee Leave Report');
            $sheet->setCellValue('A2', 'Report Date Range between ' . $start_date . " and " . $end_date);

            $sheet->setCellValue('A3', 'Name');
            $sheet->setCellValue('B3', 'Department Name');
            $sheet->setCellValue('C3', 'Leave Start Date');
            $sheet->setCellValue('D3', 'Leave End Date');
            $sheet->setCellValue('E3', 'Submit Date');
            $sheet->setCellValue('F3', 'Leave Status');


            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $styleArray = array(

                'font' => array(
                    'bold' => true,
                    'name' => 'Calibri',
                    'size' => 12,
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                ),
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '3333FF',
                    ),

                ),
            );

            $styleArray2 = array(


                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

            );

            $sheet->getStyle('A:B')->applyFromArray($styleArray2);
            $sheet->getStyle('C:D')->applyFromArray($styleArray2);
            $sheet->getStyle('E:F')->applyFromArray($styleArray2);

            $sheet->getStyle('A1')->applyFromArray($styleArray);
            $sheet->getStyle('A2')->applyFromArray($styleArray);
            $sheet->getStyle('A3:B3')->applyFromArray($styleArray);
            $sheet->getStyle('C3:D3')->applyFromArray($styleArray);
            $sheet->getStyle('E3:F3')->applyFromArray($styleArray);


            $rows = 4;
            foreach ($leave_data as $data) {
                $sheet->setCellValue('A' . $rows, $data->employee_name);
                $sheet->setCellValue('B' . $rows, $data->department_name);
                $sheet->setCellValue('C' . $rows, $data->start_date);
                $sheet->setCellValue('D' . $rows, $data->end_date);
                $sheet->setCellValue('E' . $rows, $data->submit_date);
                $sheet->setCellValue('F' . $rows, $data->leave_status);
                $rows++;
            }


            $fileName = 'Weekly Employee Leave Report.xlsx';

            $writer = new Xlsx($spreadsheet);
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        } else {
            session()->flash('leave_report_check', 'There are no employee leave data for selected week');
            return back();
        }


    }

    public function downloadYearlyAttend(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'year' => 'required',
        ]);

        $department_id = $request->department_id;

        $year = $request->year;
        

        $yearly_attend_data = DB::table('employees')
            ->join('attendances', function ($join) use ($year) {
                $join->on('employees.id', '=', 'attendances.employee_id')->where('attendances.date', 'LIKE', '%' . $year . '%')
                    ->groupBy('employees.position_code');
            })
            ->join('departments', function ($join) use ($department_id) {
                $join->on('employees.department_id', '=', 'departments.id')->where('departments.id', $department_id);
            })->limit(3)
            ->select('employees.name as employee_name', 'employees.gender', 'employees.date_of_birth', 'employees.email', 'employees.phone', 'departments.name as department_name')
            ->distinct()
            ->get();

        if (count($yearly_attend_data) > 0) {


            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();


            $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:F2');

            $sheet->setCellValue('A1', 'Weekly Employee Leave Report');
            $sheet->setCellValue('A2', 'Report Year is ' . $year);

            $sheet->setCellValue('A3', 'Name');
            $sheet->setCellValue('B3', 'Gender');
            $sheet->setCellValue('C3', 'Date of Birth');
            $sheet->setCellValue('D3', 'Email');
            $sheet->setCellValue('E3', 'Phone');
            $sheet->setCellValue('F3', 'Department Name');


            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $styleArray = array(

                'font' => array(
                    'bold' => true,
                    'name' => 'Calibri',
                    'size' => 12,
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                ),
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '3333FF',
                    ),

                ),
            );

            $styleArray2 = array(


                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),

            );

            $sheet->getStyle('A:B')->applyFromArray($styleArray2);
            $sheet->getStyle('C:D')->applyFromArray($styleArray2);
            $sheet->getStyle('E:F')->applyFromArray($styleArray2);

            $sheet->getStyle('A1')->applyFromArray($styleArray);
            $sheet->getStyle('A2')->applyFromArray($styleArray);
            $sheet->getStyle('A3:B3')->applyFromArray($styleArray);
            $sheet->getStyle('C3:D3')->applyFromArray($styleArray);
            $sheet->getStyle('E3:F3')->applyFromArray($styleArray);


            $rows = 4;
            foreach ($yearly_attend_data as $data) {
                $sheet->setCellValue('A' . $rows, $data->employee_name);
                $sheet->setCellValue('B' . $rows, $data->gender);
                $sheet->setCellValue('C' . $rows, $data->date_of_birth);
                $sheet->setCellValue('D' . $rows, $data->email);
                $sheet->setCellValue('E' . $rows, $data->phone);
                $sheet->setCellValue('F' . $rows, $data->department_name);
                $rows++;
            }


            $fileName = 'Yearly Attend Three Employee Report.xlsx';

            $writer = new Xlsx($spreadsheet);
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        } else {
            session()->flash('yearly_attend_report_check', 'There are no yearly attend three employee data for selected year');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
