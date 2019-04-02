<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionsRequest;
use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
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

        $positions=Position::paginate(4);

        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionsRequest $request)
    {

        $position_name=trim($request->name);
        $position_name=ucwords($position_name);
        $position_code=explode(' ',$position_name);
        $code_name='';
        foreach ($position_code as $code){
            $code_name.=substr($code,0,1);
        }


        Position::create(['code'=>$code_name,'name'=>$request->name]);
        $request->session()->flash('position_create', 'Position has been created');
        return redirect('admin/position');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position=Position::find($id);
        return view('positions.edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionsRequest $request, $id)
    {
        $position_name=trim($request->name);
        $position_name=ucwords($position_name);
        $position_code=explode(' ',$position_name);
        $code_name='';
        foreach ($position_code as $code){
            $code_name.=substr($code,0,1);
        }
        $position=Position::find($id);
        $position->code=$code_name;
        $position->name=$request->name;
        $position->save();

        $request->session()->flash('position_update', 'Position has been updated');
        return redirect('admin/position');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::find($id)->delete();
        session()->flash('position_delete', 'Position has been deleted');
        return redirect('admin/position');
    }
}
