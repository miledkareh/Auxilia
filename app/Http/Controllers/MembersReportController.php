<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Family;
use App\FamilyMember;
class MembersReportController extends Controller
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
        return view('MembersReport.index')->with('members', DB::select("select *,(select sum(cAmount) from family_main_accounts where family_member_id=family_members.id) as sumAmount,(select FamilyName from families where id=family_members.family_id) as FamilyName from family_members where deleted_at is null"))->with('schools', DB::select("select distinct(description) as school from family_members where Profession='School' and isnull(deleted_at)"))->with('families', Family::all())->with('statuss', DB::select("select distinct(status) as status from family_members where status <> '' and isnull(deleted_at)"));
    }
    public function filter(Request $request)
    {
        $status="";
      
        $family="";
        $profession="";
        $school="";
        if($request->status!="0")
        $status=" and status='".$request->status."'";
        if($request->family!=0)
        $family=" and family_id ='".$request->family."'";
        if($request->profession!="0")
        $profession=" and profession ='".$request->profession."'";
        if($request->school!="0")
        $school=" and description='".$request->school."'";
        
       return view('MembersReport.index')->with('members', DB::select("select *,(select sum(cAmount) from family_main_accounts where family_member_id=family_members.id) as sumAmount,(select FamilyName from families where id=family_members.family_id) as FamilyName from family_members where deleted_at is null ".$status.$family.$school.$profession))->with('schools', DB::select("select distinct(description) as school from family_members where Profession='School' and isnull(deleted_at)"))->with('families', Family::all())->with('statuss', DB::select("select distinct(status) as status from family_members where status <> '' and isnull(deleted_at)"));
       
        
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
