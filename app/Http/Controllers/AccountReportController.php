<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Sponsor;
use App\Family;
use App\Region;
use Illuminate\Support\Facades\DB;
class AccountReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fromdate=date('Y-m-d', strtotime('-2 months'));
        return view('AccountReport.index')->with('accountreports', DB::select("select *,(select symbol from currencies where id=accounts.currency_id) as symbol,(select fullname from sponsors where id=accounts.sponsor_id) as sponsor,(select FamilyName from families where id in (select family_id from family_main_accounts where id=accounts.family_main_account_id)) as family from accounts where deleted_at is null and dat >='".$fromdate."'"))->with('sponsors', Sponsor::all())->with('families', Family::all())->with('regions', Region::all());
    }
    public function filter(Request $request)
    {
        $sponsor="";
        $fromdate="";
        $todate="";
        $family="";
        $type="";
        if($request->sponsor!=0)
        $sponsor=" and sponsor_id=".$request->sponsor;
        if($request->fromdate!='')
        $fromdate=" and dat >='".$request->fromdate." 00:00:00'";
        if($request->todate!='')
        $todate=" and dat <='".$request->todate." 23:59:59'";
        if($request->family!=0)
        $family=" and family_main_account_id in(select id from family_main_accounts where family_id=".$request->family.")";
        
        if($request->type!="0"){
            $type=" or type ='".$request->type."'";
            return view('AccountReport.index')->with('accountreports', DB::select("select *,(select symbol from currencies where id=accounts.currency_id) as symbol,(select fullname from sponsors where id=accounts.sponsor_id) as sponsor,(select FamilyName from families where id in (select family_id from family_main_accounts where id=accounts.family_main_account_id)) as family from accounts where  deleted_at is null and (family_main_account_id in (select id from family_main_accounts where type='".$request->type."')  ".$type." )".$sponsor.$fromdate.$todate.$family))->with('sponsors', Sponsor::all())->with('families', Family::all())->with('regions', Region::all());
       
        }else{
            return view('AccountReport.index')->with('accountreports', DB::select("select *,(select symbol from currencies where id=accounts.currency_id) as symbol,(select fullname from sponsors where id=accounts.sponsor_id) as sponsor,(select FamilyName from families where id in (select family_id from family_main_accounts where id=accounts.family_main_account_id)) as family from accounts where  deleted_at is null ".$sponsor.$fromdate.$todate.$family))->with('sponsors', Sponsor::all())->with('families', Family::all())->with('regions', Region::all());
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
