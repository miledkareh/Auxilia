<?php

namespace App\Http\Controllers;
use App\Family;
use App\FamilyFollowup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MothersInfoController extends Controller
{
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
    public function show($family_id)
    {
        return view('MothersInfo.index')->with('family', Family::select('*')->where('id',$family_id)->get())->with('followups', FamilyFollowup::select('*')->where('family_id',$family_id)->get())->with('family_id',$family_id);
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
    public function update(Request $request, $family)
    {
        if($request->Car == null)
        $request->Car=false;
        if($request->DrivingLicense == null)
        $request->DrivingLicense=false;
        DB::table('families')
                ->where('id', $family)
                ->update([
            'LevelOfStudy' => $request->LevelOfStudy,
            'DrivingLicense' => $request->DrivingLicense,
            'Car' => $request->Car,
            'CompanyName' => $request->CompanyName,
            'CompanyLocation' => $request->CompanyLocation,
            'PaymentMode' => $request->PaymentMode,
            'HealthCare' => $request->HealthCare,
            'HomeProperty' => $request->HomeProperty,
            'NumberOfRooms' => $request->NumberOfRooms,
            'LivingRoom' => $request->LivingRoom,
            'Kitchen' => $request->Kitchen,
            'Bathroom' => $request->Bathroom,
            'State' => $request->State,
            'CNSSNumber' => $request->CNSSNumber,
            'Valid' => $request->Valid,
            'Remarks' => $request->Remarks
        ]);
        return redirect( route('families.index'));
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

//=========================== Add Family Followup======================================
public function addFollowup(Request $request){

    $Problem = $request->input('Problem');
    $Solution = $request->input('Solution');
    $NumberOfVisits = $request->input('NumberOfVisits');
    $EndOfTherapy = $request->input('EndOfTherapy');
    $FamilyTherapy = $request->input('FamilyTherapy');
    $EndOfFamilyTherapy = $request->input('EndOfFamilyTherapy');
    $Psychologist = $request->input('Psychologist');
    $family_id=$request->input('family_id');
  
    if($Problem !='' &&  $family_id != ''){
  
      $data = array('Problem'=>$Problem,'Solution'=>$Solution,'NumberOfVisits'=>$NumberOfVisits,'EndOfTherapy'=>$EndOfTherapy,'FamilyTherapy'=>$FamilyTherapy,"EndOfFamilyTherapy"=>$EndOfFamilyTherapy,"Psychologist"=>$Psychologist,"family_id"=>$family_id);
     
      // Call insertData() method of Page Model
      $value = FamilyFollowup::insertData($data);
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
  //============================End Add Family Followup=========================================
  
  //============================= Update Family Followup ===========================================
  public function updateFollowup(Request $request){
  
    $Problem = $request->input('Problem');
    $Solution = $request->input('Solution');
    $NumberOfVisits = $request->input('NumberOfVisits');
    $EndOfTherapy = $request->input('EndOfTherapy');
    $FamilyTherapy = $request->input('FamilyTherapy');
    $EndOfFamilyTherapy = $request->input('EndOfFamilyTherapy');
    $Psychologist = $request->input('Psychologist');
    $id = $request->input('id');
    
    if($Problem !=''){
     
      $data = array('Problem'=>$Problem,'Solution'=>$Solution,'NumberOfVisits'=>$NumberOfVisits,'EndOfTherapy'=>$EndOfTherapy,'FamilyTherapy'=>$FamilyTherapy,"EndOfFamilyTherapy"=>$EndOfFamilyTherapy,"Psychologist"=>$Psychologist);
       // Call updateData() method of Page Model
      FamilyFollowup::updateData($id, $data);
      echo 'Update successfully.';
    }else{
      echo 'Fill all fields.';
    }
  
    exit; 
  }
  //=============================== End Update Family Followup=====================================
  
  //=============================== Delete Family Followup===========================================
  public function deleteFollowup($id){
    // Call deleteData() method of Page Model
    FamilyFollowup::deleteData($id);
  
    echo "Delete successfully";
    exit;
  }
  //==================================== End Delete Family Followup ====================================

  //====================================== Get Family Followup =============================================
  public function getFollowup(Request $request){
    // Call getuserData() method of Page Model
    
    $memberData['data'] = FamilyFollowup::getData($request->input('id'));
  
    echo json_encode($memberData);
    exit;
  }
  //====================================== End Get Family Followup =============================================
}
