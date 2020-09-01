<?php

namespace App\Http\Controllers;
use App\Changement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Changements\AddChangementsRequest;
class ChangementsController extends Controller
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
        return view('Changements.index')->with('changements', Changement::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Changements.create')->with('groups',DB::select("select distinct(group1) as group1 from changements where group1<>''"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddChangementsRequest $request)
    {
        Changement::Create([
            'Name'=>$request->Name,
          
            'Group1'=>$request->Group1
            
        ]);
        return redirect(route('changements.index'));
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
    public function edit(Changement $changement)
    {
        return view('Changements.create')->with('changement', $changement)->with('groups',DB::select("select distinct(group1) as group1 from changements where group1<>''"));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Changement $changement)
    {
        $this->validate($request,[
            'Name'=> 'required|unique:changements,id,'.$request->id
        ]);
     $changement->update( [
        'Name'=>$request->Name,
        'Group1'=>$request->Group1
    ]);

   
     return redirect(route('changements.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Changement $changement)
    {
        $changement->Delete();
        return redirect(route('changements.index'));
    }
}
