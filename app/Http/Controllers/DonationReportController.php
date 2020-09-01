<?php

namespace App\Http\Controllers;
use App\FamilyMainAccount;
use App\Sponsor;
use App\Family;
use App\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DonationReportController extends Controller
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
        $fromdate=date('Y-m-d', strtotime('-2 months'));
        return view('DonationReport.index')->with('accountreports', DB::select("select *,(select name from family_members where id=family_main_accounts.family_member_id) as familymember,(select symbol from currencies where id=family_main_accounts.currency_id) as symbol,(select Region from families where id=family_main_accounts.family_id) as region,(select fullname from sponsors where id=family_main_accounts.sponsor_id) as sponsor,(select FamilyName from families where id = family_main_accounts.family_id) as family from family_main_accounts where deleted_at is null and date >='".$fromdate."'"))->with('sponsors', Sponsor::all())->with('families', Family::all())->with('regions', Region::all());
    
    }
    public function filter(Request $request)
    {
        $sponsor="";
        $fromdate="";
        $todate="";
        $family="";
        $type="";
        $region="";
        if($request->sponsor!=0)
        $sponsor=" and sponsor_id=".$request->sponsor;
        if($request->fromdate!='')
        $fromdate=" and date >='".$request->fromdate." 00:00:00'";
        if($request->todate!='')
        $todate=" and date <='".$request->todate." 23:59:59'";
        if($request->family!=0)
        $family=" and family_id=".$request->family;
        
        if($request->type!="0")
            $type=" and type ='".$request->type."'";
            if($request->region!="0")
            $region=" and family_id in (select id from families where region='".$request->region."')";
            return view('DonationReport.index')->with('accountreports', DB::select("select *,(select name from family_members where id=family_main_accounts.family_member_id) as familymember,(select symbol from currencies where id=family_main_accounts.currency_id) as symbol,(select Region from families where id=family_main_accounts.family_id) as region,(select fullname from sponsors where id=family_main_accounts.sponsor_id) as sponsor,(select FamilyName from families where id =family_main_accounts.family_id ) as family from family_main_accounts where  deleted_at is null  ".$type.$sponsor.$fromdate.$todate.$family.$region))->with('sponsors', Sponsor::all())->with('families', Family::all())->with('regions', Region::all());
       
        
        
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
