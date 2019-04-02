<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Http\Requests\HolidaysEditRequest;
use App\Http\Requests\HolidaysRequest;
use DateTime;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;




class HolidayController extends Controller
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


        $holidays = Holiday::paginate(4);
        return view('holidays.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidaysRequest $request)
    {
        $title = $request->title;


        $new_start_date = new DateTime($request->start_date);
        $new_end_date = new DateTime($request->end_date);


        if ($new_start_date > $new_end_date) {
            $request->session()->flash('holiday_check', 'Start date must be less than or equal end date');
            return back()->withInput();
        } else {

            Holiday::create($request->all());
            $request->session()->flash('holiday_create', 'Holiday has been created');
            return redirect('admin/holiday');
        }
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
        $holiday = Holiday::find($id);
        return view('holidays.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolidaysEditRequest $request, $id)
    {


        $holiday = Holiday::find($id);
        $holiday->update($request->all());
        $request->session()->flash('holiday_update', 'Holiday has been updated');
        return redirect('admin/holiday');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Holiday::find($id)->delete();
        session()->flash('holiday_delete', 'Holiday has been deleted');
        return redirect('admin/holiday');
    }

    public function admin_calendar()
    {
       $holidays=Holiday::paginate(4);



        return view('holidays.admin_calendar',compact('holidays'));
    }


}
