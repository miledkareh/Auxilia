<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exchange;
use App\Currency;
use App\Http\Requests\Exchanges\AddExchangesRequest;
use App\Http\Requests\Exchanges\UpdateExchangesRequest;
use Illuminate\Support\Facades\DB;
class ExchangesController extends Controller
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
        return view('Exchanges.index')->with('exchanges', DB::select("select *,(select symbol from currencies where id=exchanges.fromcurrency) as fcurrency,(select symbol from currencies where id=exchanges.tocurrency) as tcurrency from exchanges where isNull(deleted_at)"));
        //return ;
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Exchanges.create')->with('currencies', Currency::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddExchangesRequest $request)
    {
        Exchange::create([ 
            'FromCurrency' => $request->FromCurrency,
            'ToCurrency' => $request->ToCurrency,
            'FromAmount' => $request->FromAmount,
            'ToAmount' => $request->ToAmount,
            'Dat' => $request->Dat
           
        ]);
        return redirect(route('exchanges.index'));
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
    public function edit(Exchange $exchange)
    {
        return view('Exchanges.create')->with('exchange', $exchange)->with('currencies', Currency::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     /*
     *
     * Update Exchange to database
     * 
     * 
     *  */
    public function update(UpdateExchangesRequest $request, Exchange $exchange)
    {
        $exchange->update( [
       
            'FromCurrency'=>$request->FromCurrency,
            'ToCurrency'=>$request->ToCurrency,
            'FromAmount'=>$request->FromAmount,
            'ToAmount'=>$request->ToAmount,
            'Dat'=>$request->Dat,
        ]);

        return redirect(route('exchanges.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exchange $exchange)
    {
        $exchange->Delete();
        return redirect(route('exchanges.index'));
    }
}
