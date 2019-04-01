<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Department;
use App\Http\Requests\DepartmentsRequest;
use App\Schedule;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
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

        $departments = Department::paginate(4);


        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $TimeZoneList = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('departments.create', compact('TimeZoneList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentsRequest $request)
    {

        Department::create($request->all());

        $request->session()->flash('department_create', 'Department has been created');
        return redirect('admin/department');

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
        $departments = Department::find($id);


        return view('departments.edit', compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentsRequest $request, $id)    {


        $department = Department::find($id);

        $department->update($request->all());
        $request->session()->flash('department_edit', 'Department has been updated');
        return redirect('admin/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::where('department_id',$id)->delete();

        Department::find($id)->delete();

        session()->flash('department_delete', 'Department has been deleted');
        return redirect('admin/department');

    }
}
