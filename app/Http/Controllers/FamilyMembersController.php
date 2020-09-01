<?php

namespace App\Http\Controllers;
use App\FamilyMember;
use App\Family;
use App\AcademicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FamilyMembers\AddFamilyMembersRequest;
use App\Http\Requests\FamilyMembers\UpdateFamilyMembersRequest;
class FamilyMembersController extends Controller
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
        return view('FamilyMembers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddFamilyMembersRequest $request)
    {
        FamilyMember::Create([
            'DateOfBirth'=>$request->DateOfBirth,
            'family_id'=>$request->family_id,
            'Name'=>$request->Name,
            
        ]);
        return view('FamilyMembers.index')->with('family', Family::select('MotherName')->where('id',$request->family_id)->get())->with('family_id', $request->family_id)->with('familymembers', FamilyMember::All()->where('family_id',$request->family_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($family_id)
    {
        return view('FamilyMembers.index')->with('family', Family::select('MotherName')->where('id',$family_id)->get())->with('family_id',$family_id)->with('familymembers', FamilyMember::All()->where('family_id',$family_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyMember $familymember)
    {
        return view('FamilyMembers.create')->with('familymember', $familymember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyMembersRequest $request, FamilyMember $familymember)
    {
        $familymember->update([
            'DateOfBirth'=>$request->DateOfBirth,
            'family_id'=>$request->family_id,
            'Name'=>$request->Name
        ]);
        return view('FamilyMembers.index')->with('family', Family::select('MotherName')->where('id',$request->family_id)->get())->with('family_id', $request->family_id)->with('familymembers', FamilyMember::All()->where('family_id',$request->family_id));
    }
    public function getmemberInfo(Request $request){
        // Call getuserData() method of Page Model
    
        $memberData['data'] = FamilyMember::getmemberInfo($request->input('id'));
      echo json_encode($memberData);
        exit;
      }

      public function addMemberInfo(Request $request){

        $Handicap = $request->input('Handicap');
      
        $Description = $request->input('Description');
        $familymember_id=$request->input('familymember_id');
        
        if($Handicap !=''){
        
          $data = array('Handicap'=>$Handicap,'Description'=>$Description,"familymember_id"=>$familymember_id);
          // Call insertData() method of Page Model
          $value = FamilyMember::insertMemberInfoData($data);
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

      public function updateMemberInfo(Request $request){

        $Handicap = $request->input('Handicap');
      
        $Description = $request->input('Description');
        $id = $request->input('id');
      
        if($Handicap !=''){
       
          $data = array('Handicap'=>$Handicap,"Description"=>$Description);
         // Call updateData() method of Page Model
          FamilyMember::updateMemberInfoData($id, $data);
          echo 'Update successfully.';
        }else{
          echo 'Fill all fields.';
        }
    
        exit; 
      }

      public function getacademicInfo(Request $request){
        // Call getuserData() method of Page Model
    
        $memberData['data'] = AcademicInfo::getData($request->input('id'));
      echo json_encode($memberData);
        exit;
      }

      public function addAcademicInfo(Request $request){

        $Actual = $request->input('Actual');
      
        $New = $request->input('New');
        $Average = $request->input('Average');
        $Remarks = $request->input('Remarks');

        $familymember_id=$request->input('familymember_id');
        
        if($Actual !=''){
        
          $data = array('Actual'=>$Actual,'New'=>$New,'Average'=>$Average,'Remarks'=>$Remarks,"familymember_id"=>$familymember_id);
          // Call insertData() method of Page Model
          $value = AcademicInfo::insertData($data);
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

      public function updateAcademicInfo(Request $request){

        $Actual = $request->input('Actual');
      
        $New = $request->input('New');
        $Average = $request->input('Average');
        $Remarks = $request->input('Remarks');
        $id = $request->input('id');
      
        if($Actual !=''){
       
          $data = array('Actual'=>$Actual,'New'=>$New,'Average'=>$Average,'Remarks'=>$Remarks);
         // Call updateData() method of Page Model
          AcademicInfo::updateData($id, $data);
          echo 'Update successfully.';
        }else{
          echo 'Fill all fields.';
        }
    
        exit; 
      }
      public function deleteAcademicInfo($id){
        // Call deleteData() method of Page Model
        AcademicInfo::deleteData($id);
    
        echo "Delete successfully";
        exit;
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($familymember, $family_id)
    {
        DB::table('family_members')->where('id',$familymember)->delete();
        return view('FamilyMembers.index')->with('family', Family::select('MotherName')->where('id',$family_id)->get())->with('family_id', $family_id)->with('familymembers', FamilyMember::All()->where('family_id', $family_id));
    }
    public function deleteMemberInfo($id){
        // Call deleteData() method of Page Model
        FamilyMember::deleteMemberInfoData($id);
    
        echo "Delete successfully";
        exit;
      }
}
