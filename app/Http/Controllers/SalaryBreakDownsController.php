<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SalaryBreakDown;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\SalaryBreakDowns\AddSalaryBreakDownsRequest;
use App\Http\Requests\SalaryBreakDowns\UpdateSalaryBreakDownsRequest;
class SalaryBreakDownsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SalaryBreakDowns.create')->with('users', User::All());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSalaryBreakDownsRequest $request)
    {
        SalaryBreakDown::Create([
            'Description'=>$request->Description,
            'user_id'=>$request->user_id,
            'Amount'=>$request->Amount
        ]);
        return view('SalaryBreakDowns.index')->with('user_id', $request->user_id)->with('salarybreakdowns', DB::table('salary_break_downs',SalaryBreakDown::All())->where('user_id',$request->user_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return view('SalaryBreakDowns.index')->with('user_id', $user_id)->with('salarybreakdowns', DB::select('select * from salary_break_downs where user_id='.$user_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryBreakDown $salarybreakdown)
    {
        return view('SalaryBreakDowns.create')->with('salarybreakdown', $salarybreakdown)->with('users', User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryBreakDownsRequest $request, SalaryBreakDown $salarybreakdown)
    {
        $salarybreakdown->update([
            'Description'=>$request->Description,
            'user_id'=>$request->user_id,
            'Amount'=>$request->Amount,
        ]);
        return view('SalaryBreakDowns.index')->with('user_id', $request->user_id)->with('salarybreakdowns', DB::table('salarybreakdowns',SalaryBreakDown::All())->where('user_id',$request->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($salarybreakdown, $user_id)
    {
        DB::table('salary_break_downs')->where('id',$salarybreakdown)->delete();
        return view('SalaryBreakDowns.index')->with('user_id', $user_id)->with('salarybreakdowns', DB::select('select * from salary_break_downs where user_id='.$user_id));
    }
}
