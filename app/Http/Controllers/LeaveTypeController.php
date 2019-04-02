<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveTypesRequest;
use App\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
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
        $leave_types = LeaveType::paginate(4);
        return view('leave_types.index',compact('leave_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveTypesRequest $request)
    {


        LeaveType::create($request->all());
        $request->session()->flash('leave_type_create', 'Leave type has been created');
        return redirect('admin/leave_type');
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
        $leave_type=LeaveType::find($id);
        return view('leave_types.edit',compact('leave_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeaveTypesRequest $request, $id)
    {
        $leave_type=LeaveType::find($id);
        $leave_type->update($request->all());
        session()->flash('leave_type_update', 'Leave type has been updated');
        return redirect('admin/leave_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LeaveType::find($id)->delete();
        session()->flash('leave_type_delete', 'Leave type has been deleted');
        return redirect('admin/leave_type');
    }
}
