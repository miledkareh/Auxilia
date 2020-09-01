<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Currency;
use App\Sponsor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Accounts\AddAccountsRequest;
use App\Http\Requests\Accounts\UpdateAccountsRequest;
use PDF;
class AccountsController extends Controller
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
        return view('Accounts.create')->with('currencies', Currency::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAccountsRequest $request)
    {
        $exchanges=DB::select("select * from exchanges where FromCurrency =".$request->Currency." and ToCurrency =6 and Dat <='".$request->Dat."' order by id desc Limit 1");
    $cdebit=$request->Total;
        foreach($exchanges as $exchange)
    {
        $cdebit=$cdebit*$exchange->ToAmount/$exchange->FromAmount;
    }
    Account::Create([
        'Dat'=>$request->Dat,
        'sponsor_id'=>$request->sponsor_id,
        'Ref'=>$request->Ref,
        'Type'=>$request->Type,
        'Debit'=>$request->Total,
        'cDebit'=>$cdebit,
        'currency_id'=>$request->Currency,
        'Bank'=>$request->Bank,
        'Notes'=>$request->Notes,
        'PaymentMode'=>$request->PaymentMode
    ]);

    return view('Accounts.index')->with('sponsor', Sponsor::select('Fullname')->where('id',$request->sponsor_id)->get())->with('sponsor_id', $request->sponsor_id)->with('accounts', DB::table('accounts')->Join('currencies','accounts.currency_id','currencies.id')->select('accounts.*','currencies.symbol')->where('sponsor_id',$request->sponsor_id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



     
    public function show($sponsor_id)
    {
      
        return view('Accounts.index')->with('sponsor', Sponsor::select('Fullname')->where('id',$sponsor_id)->get())->with('sponsor_id', $sponsor_id)->with('accounts', DB::table('accounts')->Join('currencies','accounts.currency_id','currencies.id')->select('accounts.*','currencies.symbol')->where('sponsor_id',$sponsor_id,'deleted_at',Null)->orderBy('Dat','asc')->get());
    }

    public function attachments($account)
    {
        return view('Accounts.attachments')->with('attachments', DB::select("select * from images where tablename='familyaccount' and tableserial in (select family_main_account_id from accounts where id=".$account.")"));
    }

    public function convert_number_to_words($number) {
   
        $hyphen      = '-';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Fourty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            1000000             => 'Million',
            1000000000          => 'Billion',
            1000000000000       => 'Trillion',
            1000000000000000    => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );
       
        if (!is_numeric($number)) {
            return false;
        }
       
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
     
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
       
        $string = $fraction = null;
       
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
       
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
       
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
       
        return $string;
    }
    public function report($id)
    {

        $accounts=DB::select("select *,(select Fullname from sponsors where id=accounts.sponsor_id) as sponsor from accounts where id =".$id);
  
        foreach($accounts as $account){
        PDF::SetMargins(3, 10, 3);
        PDF::SetTitle('Receipt');
        PDF::AddPage();
      //  PDF::writeHTML($html, true, false, true, false, '');
        PDF::SetFont('dejavusans','',17);
        PDF::Cell(5,10,'',0,0,'L');
        PDF::Cell(5,10,'Auxilia - Liban',0,0,'L');
        PDF::Cell(190,10,'أوكسيليا - لبنان',0,0,'R');
        PDF::ln(7);
        PDF::SetFont('dejavusans','',8);
        PDF::Cell(8,10,'',0,0,'L');
        PDF::Cell(10,10,'Decret no. 220 / A.D',0,0,'L');
        PDF::Cell(180,10,'.علم و خبر رقم 220 / أ.د',0,0,'R');
        PDF::Image('logo.png',90,15,40); 
       
        PDF::ln(5);
        PDF::Cell(12,10,'',0,0,'L');
        PDF::Cell(10,10,'MOP: 311749',0,0,'L');
        PDF::Cell(175,10,'الرقم المالي: 311749',0,0,'R');
        PDF::ln(5);
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(10,10,'Tel: 01/246200/1/2',0,0,'L');
        PDF::Cell(179,10,'الهاتف: 01/246200/1/2',0,0,'R');
        PDF::ln(5);
        PDF::Cell(6,10,'',0,0,'L');
        PDF::Cell(10,10,'Bauchrieh-Rue St.Maron',0,0,'L');
        PDF::Cell(180,10,'البوشرية - شارع مار مرون',0,0,'R');
        PDF::ln(5);
        PDF::Cell(14,10,'',0,0,'L');
        PDF::Cell(10,10,'Imm.Saad',0,0,'L');
        PDF::Cell(165,10,'بناية سعد',0,0,'R');
       
        PDF::ln(15);

        PDF::Cell(15,5,'',0,0,'L');
        if($account->currency_id==6)
        PDF::Cell(20,5,'$ '.$account->Debit,1,0,'L');
        else
        PDF::Cell(20,5,'$ ',1,0,'L');
        PDF::Cell(125,5,'',0,0,'R');
        PDF::Cell(15,5,'Recu',0,0,'L');
        PDF::Cell(15,5,'L39001 ',0,0,'L');
        PDF::Cell(10,5,'ايصال',0,0,'R');
        PDF::ln(3);
        PDF::Cell(15,5,'Montant',0,0,'L');
        PDF::Cell(20,5,'',0,0,'L');
        PDF::Cell(10,5,'مبلغ',0,0,'L');
        PDF::ln(3);
        PDF::Cell(15,5,'',0,0,'L');
        if($account->currency_id==1)
        PDF::Cell(20,5,'LL '.$account->Debit,1,0,'L');
        else
        PDF::Cell(20,5,'LL ',1,0,'L');
        PDF::ln(10);

        PDF::Cell(5,10,'',0,0,'L');
        PDF::Cell(15,10,'Recu de',0,0,'L');
        PDF::Cell(170,10,$account->sponsor,0,0,'C');
        PDF::Cell(10,10,'وصلني من',0,0,'R');
        PDF::ln(8);
        PDF::Cell(20 ,10,'',0,0,'L');
        PDF::Cell(165,0,'','T');

        PDF::ln(10);
       
        PDF::Cell(5,5,'',0,0,'L');
        PDF::Cell(20,5,'Allocation',0,0,'L');
        if($account->Type=='Allocation'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else{
            PDF::Cell(5,5,'',1,0,'L');
        }
        
        PDF::Cell(26,5,'',0,0,'L');
        PDF::Cell(20,5,'Médicale',0,0,'L');
        if($account->Type=='Medicale'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');

        PDF::Cell(26,5,'',0,0,'L');
        PDF::Cell(20,5,'Scolaire',0,0,'L');
        if($account->Type=='Scolaire'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');

        PDF::Cell(26,5,'',0,0,'L');
        PDF::Cell(20,5,'Divers',0,0,'L');
        if($account->Type=='Divers'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');

        PDF::ln(10);

        PDF::Cell(5,10,'',0,0,'L');
        PDF::Cell(15,10,'La Somme de ',0,0,'L');
        PDF::Cell(170,10,$this->convert_number_to_words($account->Debit),0,0,'C');
        PDF::Cell(10,10,'مبلغ و قدره',0,0,'R');
        PDF::ln(8);
        PDF::Cell(25 ,10,'',0,0,'L');
        PDF::Cell(160,0,'','T');
       

        PDF::ln(10);
        PDF::Cell(5,5,'',0,0,'L');
        if($account->PaymentMode=='Cash'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');
        PDF::Cell(20,5,'Cash',0,0,'L');

        if($account->PaymentMode!='Cash'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');
        PDF::Cell(20,5,'Cheque',0,0,'L');

        PDF::Cell(80,5,'',0,0,'L');

        PDF::Cell(25,5,'بموجب شيك رقم',0,0,'L');
        if($account->PaymentMode!='Cash'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');

        PDF::Cell(10,5,'',0,0,'L');
        PDF::Cell(10,5,'نقدا',0,0,'L');
         if($account->PaymentMode=='Cash'){
            PDF::SetFont('zapfdingbats','',12);
            PDF::Cell(5,5,'3',1,0,'C');
            PDF::SetFont('dejavusans','',8);
        }
        else
        PDF::Cell(5,5,'',1,0,'L');

        PDF::ln(10);

        PDF::Cell(5,10,'',0,0,'L');
        PDF::Cell(15,10,'Tiré sur ',0,0,'L');
        PDF::Cell(170,10,$account->Bank,0,0,'C');
        PDF::Cell(10,10,'مسحوب على',0,0,'R');
        PDF::ln(8);
        PDF::Cell(16 ,10,'',0,0,'L');
        PDF::Cell(167,0,'','T');
        
        PDF::ln(10);

        PDF::Cell(5,5,'',0,0,'L');
        PDF::Cell(15,5,'Signature ',0,0,'L');
        PDF::Cell(30,5,'',1,0,'R');
        PDF::Cell(10,5,'اللإمضاء',0,0,'L');
        PDF::Cell(90,5,'',0,0,'R');
        PDF::Cell(10,5,'Date ',0,0,'L');
        PDF::Cell(30,5,date("d-m-Y", strtotime($account->Dat)),1,0,'C');
        PDF::Cell(10,5,'التاريخ',0,0,'L');
        PDF::Output('Receipt.pdf');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    


    public function edit(Account $account)
    {
        return view('Accounts.create')->with('account', $account)->with('currencies', Currency::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountsRequest $request, Account $account)
    {
        $exchanges=DB::select("select * from exchanges where FromCurrency =".$request->Currency." and ToCurrency =6 and Dat <='".$request->Dat."' order by id desc Limit 1");
        $cdebit=$request->Total;
            foreach($exchanges as $exchange)
        {
            $cdebit=$cdebit*$exchange->ToAmount/$exchange->FromAmount;
        }
        $account->update([
            'Dat'=>$request->Dat,
            'sponsor_id'=>$request->sponsor_id,
            'Ref'=>$request->Ref,
            'Type'=>$request->Type,
            'Debit'=>$request->Total,
            'cDebit'=>$cdebit,
            'currency_id'=>$request->Currency,
            'Bank'=>$request->Bank,
            'Notes'=>$request->Notes,
            'PaymentMode'=>$request->PaymentMode
        ]);
    
        return view('Accounts.index')->with('sponsor', Sponsor::select('Fullname')->where('id',$request->sponsor_id)->get())->with('sponsor_id', $request->sponsor_id)->with('accounts', DB::table('accounts')->Join('currencies','accounts.currency_id','currencies.id')->select('accounts.*','currencies.symbol')->where('sponsor_id',$request->sponsor_id)->get());
         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $sponsor_id)
    {
        DB::table('accounts')->where('id',$account)->delete();
        return view('Accounts.index')->with('sponsor', Sponsor::select('Fullname')->where('id',$sponsor_id)->get())->with('sponsor_id', $sponsor_id)->with('accounts', DB::table('accounts')->Join('currencies','accounts.currency_id','currencies.id')->select('accounts.*','currencies.symbol')->where('sponsor_id',$sponsor_id)->get());
    }

   
}
