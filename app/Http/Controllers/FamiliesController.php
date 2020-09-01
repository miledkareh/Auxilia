<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use App\FamilyMember;
use App\User;
use App\Currency;
use App\FamilyMainAccount;
use App\Sponsor;
use App\Changement;
use App\Region;
use App\Period;
use App\Image;
use App\Charge;
use App\FamilyAccount;
use App\ChangementDeclaration;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Families\AddFamiliesRequest;
use App\Http\Requests\Families\UpdateFamiliesRequest;
use Auth;
use PDF;
class FamiliesController extends Controller
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
        return view('Families.index')->with('families', DB::select('select *,(select count(*) from family_members where family_id=families.id) as cnt,(select name from users where id=families.socialhelper) as name from families where isnull(deleted_at)'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Families.create')->with('users', User::all())->with('regions', Region::all());
    }
//=====================Family Account ======================================

public function updateDetail(Request $request){

  $Name = $request->input('Name');
  $Member = $request->input('Member');
  $Currency = $request->input('Currency');
  $Amount = $request->input('Amount');
  $Period = $request->input('Period');
  $id = $request->input('id');
  $type = $request->input('Type');
  if($Name !='' && $Name != 0){
   
    $data = array('Type'=>$type,'Name'=>$Name,"member_id"=>$Member,"currency_id"=>$Currency,"Amount"=>$Amount,"period_id"=>$Period);
    FamilyAccount::updateDetail($id, $data);
    echo 'Update successfully.';
  }else{
    echo 'Fill all fields.';
  }

  exit; 
}

public function deleteDetail($id){
  // Call deleteData() method of Page Model
  FamilyAccount::deleteDetail($id);

  echo "Delete successfully";
  exit;
}


public function getDetails(Request $request){
  // Call getuserData() method of Page Model
  if($request->input('action')==1)
  $memberData['data'] = FamilyAccount::getResources($request->input('id'));
else if($request->input('action')==2)
$memberData['data'] = FamilyAccount::getCharges($request->input('id'));
  echo json_encode($memberData);
  exit;
}

public function getCharges(Request $request){
  // Call getuserData() method of Page Model
 
  $memberData['data'] = FamilyAccount::getChargesByType($request->input('Type'));
  echo json_encode($memberData);
  exit;
}

public function getFamilyMainAccount(Request $request){
  // Call getuserData() method of Page Model
 
  $memberData['data'] = FamilyMainAccount::getDataDetail($request->input('id'));
  echo json_encode($memberData);
  exit;
}
public function getSponsorAccount(Request $request){
  // Call getuserData() method of Page Model
 

  $value=DB::select('select *,(select symbol from currencies where id=accounts.currency_id) as Currency from accounts where  sponsor_id='.$request->input('id') .' order by Dat asc'); 
  echo json_encode($value);
  exit;
}

public function addDetail(Request $request){

  $Name = $request->input('Name');
  $Member = $request->input('Member');
  $Currency = $request->input('Currency');
  $Amount = $request->input('Amount');
  $Period = $request->input('Period');
  $family_id=$request->input('family_id');
  $Type = $request->input('Type');
  if($Name !='' && $Name !=0 && $family_id != ''){
  
    $data = array('Type'=>$Type,'member_id'=>$Member,'currency_id'=>$Currency,'Amount'=>$Amount,'period_id'=>$Period,"Name"=>$Name,"family_id"=>$family_id);
   
    // Call insertData() method of Page Model
    $value = FamilyAccount::insertDetail($data);
    if($value){
      echo $value;
    }else{
      echo 0;
    }

  }else{
     echo 'Fill all fields.';
  }

  exit; 
}
//=============================================================================
public function addMainAccount(Request $request){

  $Notes = $request->input('Notes');
  $Sponsor = $request->input('Sponsor');
  $Type = $request->input('Type');
  $Currency = $request->input('Currency');
  $Amount = $request->input('Amount');
  $Date = $request->input('Date');
  $family_id=$request->input('family_id');
  $Total = $request->input('Total');
  $Cheque = $request->input('Cheque');
  $Bank = $request->input('Bank');
  $family_member_id = $request->input('family_member_id');

  if($Sponsor !='' && $Sponsor !=0 && $family_id != ''){
  
    $exchanges=DB::select("select * from exchanges where FromCurrency =".$Currency." and ToCurrency =6 and DATE(Dat) <='".$Date."' order by id desc Limit 1");
   
    $cAmount=$Amount;
        foreach($exchanges as $exchange)
    {
        $cAmount=$cAmount*$exchange->ToAmount/$exchange->FromAmount;
    }
if($Total<$cAmount)
echo -1;
else{
    $data = array('Bank'=>$Bank,'Cheque'=>$Cheque,'Date'=>$Date,'family_member_id'=>$family_member_id,'Type'=>$Type,'cAmount'=>$cAmount,'sponsor_id'=>$Sponsor,'currency_id'=>$Currency,'Amount'=>$Amount,'Notes'=>$Notes,"family_id"=>$family_id);
   
    // Call insertData() method of Page Model
    $value = FamilyMainAccount::insertData($data);
    if($value){
      DB::insert("update images set tableserial=$value where tableserial=0 and tablename='familyaccount' and user_id=".Auth::user()->id);

    DB::insert("insert into accounts(Dat,Credit,cCredit,currency_id,sponsor_id,notes,family_main_account_id,Type) values ('$Date','$Amount','$cAmount','$Currency','$Sponsor','$Notes','$value','$Type') ");

      echo $value;
    }else{
      echo 0;
    }
  }
  }else{
     echo 'Fill all fields.';
  }

  exit; 
}

public function updateMainAccount(Request $request){

  $Notes = $request->input('Notes');
  $Sponsor = $request->input('Sponsor');
  $Type = $request->input('Type');
  $Currency = $request->input('Currency');
  $Amount = $request->input('Amount');
  $Date = $request->input('Date');
  $id = $request->input('id');
  $Total = $request->input('Total');
  $Cheque = $request->input('Cheque');
  $Bank = $request->input('Bank');
  $family_member_id = $request->input('family_member_id');
  if($Sponsor !='' && $Sponsor != 0){
   
    $exchanges=DB::select("select * from exchanges where FromCurrency =".$Currency." and ToCurrency =6 and DATE(Dat) <='".$Date."' order by id desc Limit 1");
    $cAmount=$Amount;
        foreach($exchanges as $exchange)
    {
        $cAmount=$cAmount*$exchange->ToAmount/$exchange->FromAmount;
    }
    if($Total<$cAmount)
    echo -1;
    else{
    $data = array('Bank'=>$Bank,'Cheque'=>$Cheque,'family_member_id'=>$family_member_id,'Date'=>$Date,"sponsor_id"=>$Sponsor,"currency_id"=>$Currency,"Amount"=>$Amount,"cAmount"=>$cAmount,'Notes'=>$Notes,'Type'=>$Type);
    FamilyMainAccount::updateData($id, $data);
    DB::update("update  accounts set Type='$Type',dat='$Date',Credit='$Amount',cCredit='$cAmount',currency_id='$Currency',sponsor_id='$Sponsor',notes='$Notes' where family_main_account_id=$id ");
    echo 'Update successfully.';
  }
  }else{
    echo 'Fill all fields.';
  }

  exit; 
}

public function deleteMainAccount($id){
  // Call deleteData() method of Page Model
  FamilyMainAccount::deletedata($id);

  echo "Delete successfully";
  exit;
}
//===================== End of Family Account===============================
//=========================== Add Changement ================================================
public function addChangement(Request $request){

  $changement_id = $request->input('changement_id');
  $Remarks = $request->input('Remarks');
  $Date = $request->input('Date');
  $Type = $request->input('Type');
  
  $family_id=$request->input('family_id');

  if($changement_id !='' && $changement_id !=0 && $family_id != ''){
  
    $data = array('Type'=>$Type,'changement_id'=>$changement_id,'Remarks'=>$Remarks,'Date'=>$Date,"family_id"=>$family_id);
   
    // Call insertData() method of Page Model
    $value = ChangementDeclaration::insertData($data);
    if($value){
      echo $value;
    }else{
      echo 0;
    }

  }else{
     echo 'Fill all fields.';
  }

  exit; 
}
public function UploadImage(Request $request){
  if($request->hasFile('images')){
    foreach($request->images as $image){
      
      $image=$image->store('familyaccount');
      DB::insert("insert into images(name,tablename,tableserial,user_id) values ('$image','".$request->input('table')."','".$request->input('serial')."','".Auth::user()->id."') ");
    }
    echo json_encode('Uploaded successfully.');
    exit;
  }
}
public function deleteimage(Request $request){
  DB::table('images')->where('id',$request->id)->delete();
  echo json_encode('Deleted Successfully.');
  exit;
}
public function updateChangement(Request $request){

  $changement_id = $request->input('changement_id');
  $Type = $request->input('Type');
  $Remarks = $request->input('Remarks');
  $Date = $request->input('Date');
 
  $id = $request->input('id');
  if($changement_id !='' && $changement_id != 0){
   
    $data = array('Type'=>$Type,'changement_id'=>$changement_id,"Remarks"=>$Remarks,"Date"=>$Date);
    ChangementDeclaration::updateData($id, $data);
    echo 'Update successfully.';
  }else{
    echo 'Fill all fields.';
  }

  exit; 
}
public function deleteChangement($id){
  // Call deleteData() method of Page Model
  ChangementDeclaration::deleteData($id);

  echo "Delete successfully";
  exit;
}
//=========================================================================
    public function updateMember(Request $request){

        $Name = $request->input('Name');
        $DateOfBirth = $request->input('DateOfBirth');
        $Status = $request->input('Status');
        $Profession = $request->input('Profession');
        $Position = $request->input('Position');
        $Description = $request->input('Description');
        $id = $request->input('id');
        $action = $request->input('action');
        if($Name !='' && $DateOfBirth != ''){
          if($action==1)
          $data = array('InHouse'=>0,'Position'=>$Position,'Name'=>$Name,"DateOfBirth"=>$DateOfBirth,"Status"=>$Status,"Profession"=>$Profession,"Description"=>$Description);
          else if($action==2)
          $data = array('InHouse'=>1,'Position'=>$Position,'Name'=>$Name,"DateOfBirth"=>$DateOfBirth,"Status"=>$Status,"Profession"=>$Profession,"Description"=>$Description);
          // Call updateData() method of Page Model
          FamilyMember::updateData($id, $data);
          echo 'Update successfully.';
        }else{
          echo 'Fill all fields.';
        }
    
        exit; 
      }

      public function deleteMember($id){
        // Call deleteData() method of Page Model
        FamilyMember::deleteData($id);
    
        echo "Delete successfully";
        exit;
      }

      
    public function getMembers(Request $request){
        // Call getuserData() method of Page Model
        if($request->input('action')==1)
        $memberData['data'] = FamilyMember::getmemberData($request->input('id'));
    else if($request->input('action')==2)
    $memberData['data'] = FamilyMember::getmemberDataInHouse($request->input('id'));
        echo json_encode($memberData);
        exit;
      }

      public function getImages(Request $request){

        $memberData = Image::getData($request->input('id'),$request->input('table'));
  
        echo json_encode($memberData);
        exit;
      }

      
    public function addMember(Request $request){

        $Name = $request->input('Name');
        $DateOfBirth = $request->input('DateOfBirth');
        $Status = $request->input('Status');
        $Profession = $request->input('Profession');
        $Position = $request->input('Position');
        $Description = $request->input('Description');
        $family_id=$request->input('family_id');
        $action = $request->input('action');
        if($Name !='' && $DateOfBirth !='' && $family_id != ''){
          if($action==1)
          $data = array('InHouse'=>0,'Position'=>$Position,'Status'=>$Status,'Profession'=>$Profession,'Description'=>$Description,'DateOfBirth'=>$DateOfBirth,"Name"=>$Name,"family_id"=>$family_id);
          else
          $data = array('InHouse'=>1,'Position'=>$Position,'Status'=>$Status,'Profession'=>$Profession,'Description'=>$Description,'DateOfBirth'=>$DateOfBirth,"Name"=>$Name,"family_id"=>$family_id);
          // Call insertData() method of Page Model
          $value = FamilyMember::insertData($data);
          if($value){
            echo $value;
          }else{
            echo 0;
          }
    
        }else{
           echo 'Fill all fields.';
        }
    
        exit; 
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddFamiliesRequest $request)
    {
      $insertid = DB::table('families')->insertGetId([ 
            'MotherName' => $request->MotherName,
            'Address' => $request->Address,
            'Region' => $request->Region,
            'Phone' => $request->Phone,
            'Mobile' => $request->Mobile,
            'Email' => $request->Email,
            'SocialHelper' => $request->SocialHelper,
            'FamilyName' => $request->FamilyName,
            'Date' => $request->Date,
            'Religion' => $request->Religion,
            'Street' => $request->Street,
            'Place' => $request->Place,
            'Building' => $request->Building,
            'Floor' => $request->Floor,
            'RelativeName' => $request->RelativeName
           
        ]);
        session()->flash('success','Family created successfully.');
        return redirect( route('families.edit', $insertid));
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
    public function edit(Family $family)
    {
        return view('Families.create')->with('family', $family)->with('users', User::all())->with('regions', Region::all());
    }

    public function details($family)
    {
        return view('Families.details')->with('accountresources', FamilyAccount::select('*')->where('family_id',$family)->where('Type',1)->get())->with('accountcharges', FamilyAccount::select('*')->where('family_id',$family)->where('Type',2)->get())->with('family', Family::select('*')->where('id',$family)->get())->with('charges', Charge::all())->with('currencies', Currency::all())->with('familymembers', FamilyMember::select('id','Name')->where('family_id', $family)->get())->with('periods', Period::all());
    }
    public function account($family)
    {
        return view('Families.account')->with('mainaccounts', DB::select("select *,(select name from family_members where id=family_main_accounts.family_member_id ) as familymember,(select symbol from currencies where id=family_main_accounts.currency_id) as symbol,(select Fullname from sponsors where id=family_main_accounts.sponsor_id) as sponsorN from family_main_accounts where family_id=$family"))->with('family', Family::select('*')->where('id',$family)->get())->with('currencies', Currency::all())->with('sponsors', Sponsor::all())->with('members', FamilyMember::select('*')->where('family_id',$family)->get());
    }
    public function attachments($family)
    {
        return view('Families.account')->with('mainaccounts', DB::select("select *,(select name from family_members where id=family_main_accounts.family_member_id ) as familymember,(select symbol from currencies where id=family_main_accounts.currency_id) as symbol,(select Fullname from sponsors where id=family_main_accounts.sponsor_id) as sponsorN from family_main_accounts where family_id=$family"))->with('family', Family::select('*')->where('id',$family)->get())->with('currencies', Currency::all())->with('sponsors', Sponsor::all())->with('members', FamilyMember::select('*')->where('family_id',$family)->get());
    }
    public function declaration($family)
    {
        return view('Families.ChangementDeclaration')->with('declarations', ChangementDeclaration::select('*')->where('family_id',$family)->get())->with('changementdata', Changement::all())->with('family', Family::select('*')->where('id',$family)->get());
    }
    public function MotherInfoEdit(Family $family)
    {
        return view('Families.MotherInfo')->with('family', $family);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamiliesRequest $request,  Family $family)
    {
        $family->Update([
            'MotherName' => $request->MotherName,
            'Address' => $request->Address,
            'Region' => $request->Region,
            'Phone' => $request->Phone,
            'Mobile' => $request->Mobile,
            'SocialHelper' => $request->SocialHelper,
            'Email' => $request->Email,
            'FamilyName' => $request->FamilyName,
            'Date' => $request->Date,
            'Street' => $request->Street,
            'Place' => $request->Place,
            'Building' => $request->Building,
            'Floor' => $request->Floor,
            'Religion' => $request->Religion,
            'RelativeName' => $request->RelativeName
        ]);
        session()->flash('success','Family created successfully.');
        return redirect( route('families.edit', $family->id));
    }

    public function updateMotherInfo(Request $request,  Family $family)
    {
        $family->Update([
            'LevelOfStudy' => $request->LevelOfStudy,
            'Address' => $request->Address,
            'Region' => $request->Region,
            'Phone' => $request->Phone,
            'Mobile' => $request->Mobile,
            'SocialHelper' => $request->SocialHelper,
            'Email' => $request->Email,
            'FamilyName' => $request->FamilyName,
            'Date' => $request->Date,
            'Street' => $request->Street,
            'Place' => $request->Place,
            'Building' => $request->Building,
            'Floor' => $request->Floor,
            'RelativeName' => $request->RelativeName
        ]);
        session()->flash('success','Family created successfully.');
        return redirect( route('families.edit', $family->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $family->Delete();
        return redirect(route('families.index'));
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

      $accounts=DB::select("select *,(select name from users where id=families.socialhelper) as socialHelper from families where id=".$id);

      foreach($accounts as $account){
      PDF::SetMargins(8, 10, 8);
      PDF::SetTitle('Family File');
      PDF::AddPage();
    //  PDF::writeHTML($html, true, false, true, false, '');
      PDF::SetFont('dejavusans','',17);
      
      PDF::Cell(5,10,'Auxilia - Liban',0,0,'L');
      PDF::Cell(190,10,'أوكسيليا - لبنان',0,0,'R');
      PDF::Image('logo.png',90,15,40); 
      PDF::ln(40);
      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Family Information: ',0,0,'L');
      PDF::ln(10);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Family Name: ',0,0,'L');
      PDF::Cell(5,10,$account->FamilyName,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(20,10,'Phone: ',0,0,'L');
      PDF::Cell(5,10,$account->Phone,0,0,'L');

      PDF::ln(8);
     
      
      PDF::Cell(35,10,'Region: ',0,0,'L');
      PDF::Cell(5,10,$account->Region,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(20,10,'Street: ',0,0,'L');
      PDF::Cell(5,10,$account->Street,0,0,'L');
     
      PDF::ln(8);
     
      
      PDF::Cell(35,10,'Address: ',0,0,'L');
      PDF::Cell(5,10,$account->Address,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(20,10,'Place: ',0,0,'L');
      PDF::Cell(5,10,$account->Place,0,0,'L');

      PDF::ln(8);
     
      
      PDF::Cell(35,10,'Building: ',0,0,'L');
      PDF::Cell(5,10,$account->Building,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(20,10,'Floor: ',0,0,'L');
      PDF::Cell(5,10,$account->Floor,0,0,'L');

      PDF::ln(8);
     
      
      PDF::Cell(35,10,'Religion: ',0,0,'L');
      PDF::Cell(5,10,$account->Religion,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(30,10,'Social Helper: ',0,0,'L');
      PDF::Cell(5,10,$account->socialHelper,0,0,'L');

      PDF::ln(12);
      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Mother Information: ',0,0,'L');
      PDF::ln(10);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Level Of study: ',0,0,'L');
      PDF::Cell(5,10,$account->LevelOfStudy,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(35,10,'Driving License: ',0,0,'L');
      if($account->DrivingLicense==1)
      PDF::Cell(5,10,'Yes',0,0,'L');
      else
      PDF::Cell(5,10,'No',0,0,'L');

      //============= Work Information ============
    
      PDF::ln(10);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Company Name: ',0,0,'L');
      PDF::Cell(5,10,$account->CompanyName,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'Location: ',0,0,'L');
      PDF::Cell(5,10,$account->CompanyLocation,0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Payment Mode: ',0,0,'L');
      PDF::Cell(5,10,$account->PaymentMode,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'Health Care: ',0,0,'L');
      PDF::Cell(5,10,$account->HealthCare,0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'CNSS Number: ',0,0,'L');
      PDF::Cell(5,10,$account->CNSSNumber,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'Valid: ',0,0,'L');
      if($account->Valid==1)
      PDF::Cell(5,10,'Yes',0,0,'L');
      else
      PDF::Cell(5,10,'No',0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Remarks: ',0,0,'L');
      PDF::Cell(200,10,$account->Remarks,0,0,'L');
// Home Information
      PDF::ln(12);
      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Home Information: ',0,0,'L');
      PDF::ln(10);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Home Property: ',0,0,'L');
      PDF::Cell(5,10,$account->HomeProperty,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'Number of Rooms: ',0,0,'L');
      PDF::Cell(5,10,$account->NumberOfRooms,0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Living Room: ',0,0,'L');
      PDF::Cell(5,10,$account->LivingRoom,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'Kitchen: ',0,0,'L');
      PDF::Cell(5,10,$account->Kitchen,0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Bathroom: ',0,0,'L');
      PDF::Cell(5,10,$account->Bathroom,0,0,'L');
      PDF::Cell(90,10,'',0,0,'L');
      PDF::Cell(40,10,'State: ',0,0,'L');
      PDF::Cell(5,10,$account->State,0,0,'L');

      PDF::ln(8);
      PDF::SetFont('dejavusans','',12);
      
      PDF::Cell(35,10,'Remarks: ',0,0,'L');
      PDF::Cell(200,10,$account->Remarks,0,0,'L');

      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Psychological follow-up',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Problems</b></th>
		<th><b># Visits</b></th>
		<th><b>Solution</b></th>
		<th><b>End of therapy</b></th>
    <th><b>Family therapy</b></th>
    <th><b>End of therapy</b></th>
    <th><b>Psychologist</b></th>
  </tr>';
  $followups=DB::select("select * from family_followups where family_id=".$id." and isnull(deleted_at)");

      foreach($followups as $followup){
        $html.='<tr>
        <td>'.$followup->Problem.'</td>
      <td>'.$followup->NumberOfVisits.'</td>
      <td>'.$followup->Solution.'</td>
      <td>'.$followup->EndOfTherapy.'</td>
      <td>'.$followup->FamilyTherapy.'</td>
      <td>'.$followup->EndOfFamilyTherapy.'</td>
      <td>'.$followup->Psychologist.'</td>
    </tr>';
 
      }
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');
     
      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Family Members',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Name</b></th>
		<th><b>DOB</b></th>
		<th><b>Position</b></th>
		<th><b>Status</b></th>
    <th><b>Profession</b></th>
    <th><b>Description</b></th>
    
  </tr>';
  $familymembers=DB::select("select * from family_members where family_id=".$id." and isnull(deleted_at)");

      foreach($familymembers as $familymember){
        $html.='<tr>
        <td>'.$familymember->Name.'</td>
      <td>'.$familymember->DateOfBirth.'</td>
      <td>'.$familymember->Position.'</td>
      <td>'.$familymember->Status.'</td>
      <td>'.$familymember->Profession.'</td>
      <td>'.$familymember->Description.'</td>
    </tr>';
    $details=DB::select("select * from member_details where familymember_id=".$familymember->id);

    if(sizeof($details)>0)
    $html.='
    <tr>
    <td colspan="6" align="center"><b>Psychological Informations</b></td>
    </tr>
    <tr>
    <td><b>Handicap</b></td>
  <td colspan="5"><b>Description</b></td>
</tr>';
   
    foreach($details as $detail){
      $html.='<tr>
      <td>'.$detail->Handicap.'</td>
    <td colspan="5">'.$detail->Description.'</td>
  </tr>';
    }


    $academics=DB::select("select * from academic_infos where familymember_id=".$familymember->id);

    if(sizeof($academics)>0)
    $html.='
    <tr>
    <td colspan="6" align="center"><b>Academic Results</b></td>
    </tr>
    <tr>
    <td><b>Actual</b></td>
  <td ><b>New</b></td>
  <td ><b>Average</b></td>
  <td colspan="3"><b>Remarks</b></td>
</tr>';
   
    foreach($academics as $academic){
      $html.='<tr>
      <td>'.$academic->Actual.'</td>
      <td>'.$academic->New.'</td>
      <td>'.$academic->Average.'</td>
    <td colspan="3">'.$academic->Remarks.'</td>
  </tr>';
    }

      }

      
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');

     


      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Changement declarations',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Declaration</b></th>
		<th><b>Date</b></th>
		<th><b>Type</b></th>
		<th><b>Remarks</b></th>
  </tr>';
  $declarations=DB::select("select *,(select name from changements where id=changement_declarations.changement_id) as changement from changement_declarations where family_id=".$id." and isnull(deleted_at)");

      foreach($declarations as $declaration){
        $html.='<tr>
        <td>'.$declaration->changement.'</td>
      <td>'.$declaration->Date.'</td>
      <td>'.$declaration->Type.'</td>
      <td>'.$declaration->Remarks.'</td>
    </tr>';
 
      }
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');

     

      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Family Resources/Month',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Resource</b></th>
    <th><b>Member</b></th>
    <th><b>Period</b></th>
    <th><b>Currency</b></th>
    <th><b>Amount</b></th>
    
  </tr>';
  $familyaccounts=DB::select("select *,(select name from periods where id=family_accounts.period_id) as Period,(select name from charges where id=family_accounts.name) as charge,(select symbol from currencies where id=family_accounts.currency_id) as Symbol,(select name from family_members where id=family_accounts.member_id) as Member from family_accounts where family_id=".$id." and isnull(deleted_at) and type=1");
$total=0;
      foreach($familyaccounts as $familyaccount){
        $total+=$familyaccount->Amount;
        $html.='<tr>
        <td>'.$familyaccount->charge.'</td>
      <td>'.$familyaccount->Member.'</td>
      <td>'.$familyaccount->Period.'</td>
      <td>'.$familyaccount->Symbol.'</td>
      <td>'.number_format($familyaccount->Amount).'</td>
    </tr>';
 
      }
      $html.='<tr><td colspan="4" align="right">Total </td><td>'.number_format($total).'</td></tr>';
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');

      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Family Charges/Month',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Resource</b></th>
    <th><b>Member</b></th>
    <th><b>Period</b></th>
    <th><b>Currency</b></th>
    <th><b>Amount</b></th>
    
  </tr>';
  $familyaccounts=DB::select("select *,(select name from periods where id=family_accounts.period_id) as Period,(select name from charges where id=family_accounts.name) as charge,(select symbol from currencies where id=family_accounts.currency_id) as Symbol,(select name from family_members where id=family_accounts.member_id) as Member from family_accounts where family_id=".$id." and isnull(deleted_at) and type=2");
$total=0;
      foreach($familyaccounts as $familyaccount){
        $total+=$familyaccount->Amount;
        $html.='<tr>
        <td>'.$familyaccount->charge.'</td>
      <td>'.$familyaccount->Member.'</td>
      <td>'.$familyaccount->Period.'</td>
      <td>'.$familyaccount->Symbol.'</td>
      <td>'.number_format($familyaccount->Amount).'</td>
    </tr>';
 
      }
      $html.='<tr><td colspan="4" align="right">Total </td><td>'.number_format($total).'</td></tr>';
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');

      PDF::ln(12);

      PDF::SetFont('dejavusans','U',14);
      
      PDF::Cell(30,10,'Family Account',0,0,'L');
      PDF::ln(12);
      PDF::SetFont('dejavusans','',8);
      $html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">';
      $html.='<tr bgcolor="#353F4B" color="#FFFFFF">
      <th><b>Date</b></th>
		<th><b>Sponsor</b></th>
		<th><b>Member</b></th>
    <th><b>Type</b></th>
    <th><b>Notes</b></th>
    <th><b>Currency</b></th>
    <th><b>Amount</b></th>
  </tr>';
  $accounts=DB::select("select *,(select symbol from currencies where id=family_main_accounts.currency_id) as Symbol,(select name from family_members where id=family_main_accounts.family_member_id) as Member,(select fullname from sponsors where id=family_main_accounts.sponsor_id) as Sponsor from family_main_accounts where family_id=".$id." and isnull(deleted_at)");
$total=0;
      foreach($accounts as $account){
        $total+=$account->cAmount;
        $html.='<tr>
        <td>'.$account->Date.'</td>
      <td>'.$account->Sponsor.'</td>
      <td>'.$account->Member.'</td>
      <td>'.$account->Type.'</td>
      <td>'.$account->Notes.'</td>
      <td>'.$account->Symbol.'</td>
      <td>'.number_format($account->Amount).'</td>
    </tr>';
 
      }
      $html.='<tr><td colspan="6" align="right">Total USD</td><td>'.number_format($total).'</td></tr>';
      $html.='</table>';
      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('file.pdf');
      }
  }

    public function cheque($id)
    {

        $accounts=DB::select("select *,DATE(Date) as Date,(select symbol from currencies where id=family_main_accounts.currency_id)as symbol,(select Name from family_members where id=family_main_accounts.family_member_id) as member from family_main_accounts where id =".$id);
  
        foreach($accounts as $account){
        PDF::SetMargins(20, 10, 20);
        PDF::SetTitle('Receipt');
        PDF::AddPage();
        PDF::SetTextColor(105,105,105);
      //  PDF::writeHTML($html, true, false, true, false, '');
        PDF::SetFont('dejavusans','',12);
        PDF::Cell(70,10,'',0,0,'L');
        PDF::Cell(20,10,'سند صرف',0,0,'C');
      
        PDF::ln(7);
        PDF::SetFont('dejavusans','B',17);
        PDF::Cell(70,10,'',0,0,'L');
        PDF::Cell(20,10,'',0,0,'C');
        PDF::Cell(45,10,'',0,0,'C');
        PDF::SetFont('dejavusans','',12);
        PDF::Cell(40,10,'',0,0,'C');
        PDF::ln(8);
        PDF::SetFont('dejavusans','I',12);
        PDF::Cell(70,10,'',0,0,'L');
        PDF::SetTextColor(255,0,0);
        PDF::Cell(20,10,'',0,0,'C');
        PDF::Cell(45,10,'',0,0,'C');
        PDF::SetFont('dejavusans','',12);
        PDF::SetFillColor(192,192,192); 
        PDF::SetTextColor(105,105,105);
        PDF::Cell(40,10,$account->Amount,0,0,'C');

        PDF::ln(10);

        PDF::SetTextColor(105,105,105);
        PDF::SetFont('dejavusans','',12);
        PDF::Cell(20,10,'',0,0,'L');
        PDF::Cell(137,10,$account->member,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');
       
        PDF::ln(10);

       
        PDF::Cell(20,10,'',0,0,'L');
        PDF::Cell(137,10,$this->convert_number_to_words($account->cAmount),0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');

        PDF::ln(10);
        
     
        PDF::Cell(20,10,'',0,0,'L');
        PDF::Cell(137,10,$account->Type,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');

        PDF::ln(10);
        
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(60,10,$account->Bank,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');
        PDF::Cell(2,10,'',0,0,'L');
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(56,10,$account->Cheque,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');

        PDF::ln(10);
        
        PDF::Cell(90,10,'',0,0,'C');
       
        PDF::Cell(88,10,'',0,0,'R');
        
        PDF::ln(10);
        
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(70,10,'',0,0,'C');
        PDF::Cell(10,10,'',0,0,'R');
        PDF::ln(10);
        
        PDF::Cell(23,10,'',0,0,'L');
        PDF::Cell(57,10,'',0,0,'L');
        PDF::Cell(10,10,'',0,0,'R');

        PDF::ln(25);

        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(35,10,'',0,0,'L');
        PDF::Cell(70,10,'',0,0,'R');
        PDF::Cell(12,10,$account->symbol,0,0,'C');
        PDF::Cell(5,10,'',0,0,'R');
        PDF::Cell(50,10,$account->Amount,0,0,'C');

        PDF::ln(15);
        PDF::SetFont('dejavusans','',12);
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(20,10,"",0,0,'L');
        PDF::Cell(133,10,$account->member,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');
        PDF::ln(10);

        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(20,10,"",0,0,'L');
        PDF::Cell(133,10,$this->convert_number_to_words($account->Amount),0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');

        PDF::ln(10);

       
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(80,10,"",0,0,'L');
        PDF::Cell(20,10,$account->Date,0,0,'L');
  
        PDF::ln(25);

        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(35,10,'',0,0,'L');
        PDF::Cell(70,10,'',0,0,'R');
        PDF::Cell(12,10,'',0,0,'C');
        PDF::Cell(5,10,'',0,0,'R');
        PDF::Cell(50,10,$account->Amount,0,0,'C');

        PDF::ln(15);
        PDF::SetFont('dejavusans','',12);
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(20,10,"",0,0,'L');
        PDF::Cell(133,10,$account->member,0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');
        PDF::ln(10);

        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(20,10,"",0,0,'L');
        PDF::Cell(133,10,$this->convert_number_to_words($account->Amount),0,0,'C');
        PDF::Cell(20,10,'',0,0,'R');

        PDF::ln(10);

       
        PDF::Cell(10,10,'',0,0,'L');
        PDF::Cell(80,10,"",0,0,'L');
        PDF::Cell(20,10,$account->Date,0,0,'L');
        PDF::Output('Receipt.pdf');
        }
    }


}
