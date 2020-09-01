<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\Http\Requests\Currencies\AddCurrencyRequest;
use App\Http\Requests\Currencies\UpdateCurrencyRequest;
class CurrenciesController extends Controller
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
        return view('Currencies.index')->with('currencies', Currency::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // Save new currency into database
    public function store(AddCurrencyRequest $request)
    {
        Currency::create([ 
            'symbol' => $request->symbol
           
        ]);
        return redirect(route('currencies.index'));
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
    public function edit(Currency $currency)
    {
        return view('Currencies.create')->with('currency', $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Currency $currency)
    {
  
        $this->validate($request,[
          
            'symbol'=> 'required|unique:currencies,id,'.$request->id
        ]);
     $currency->update( [
       
        'symbol'=>$request->symbol,
    ]);

   
     return redirect(route('currencies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->forceDelete();
        return redirect(route('currencies.index'));
    }
}
