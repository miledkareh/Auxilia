<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Sponsors\AddSponsorsRequest;
use App\Http\Requests\Sponsors\UpdateSponsorsRequest;
use Illuminate\Support\Facades\DB;
use App\Sponsor;
class SponsorsController extends Controller
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
        return view('Sponsors.index')->with('sponsors',DB::select("select *,(select sum(cDebit)-sum(cCredit) from accounts where sponsor_id=sponsors.id) as balance from sponsors where isnull(deleted_at)"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSponsorsRequest $request)
    {
        Sponsor::create([ 
            'Fullname' => $request->Fullname,
            'Address' => $request->Address,
            'Address2' => $request->Address2,
            'Phone' => $request->Phone,
            'Mobile' => $request->Mobile,
            'Email' => $request->Email,
           
        ]);
        return redirect(route('sponsors.index'));
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
    public function edit(Sponsor $sponsor)
    {
        return view('Sponsors.create')->with('sponsor', $sponsor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorsRequest $request,Sponsor $sponsor)
    {
        $sponsor->Update([
            'Fullname' => $request->Fullname,
            'Address' => $request->Address,
            'Address2' => $request->Address2,
            'Phone' => $request->Phone,
            'Mobile' => $request->Mobile,
            'Email' => $request->Email
        ]);
        return redirect(route('sponsors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->Delete();
        return redirect(route('sponsors.index'));
    }
}
