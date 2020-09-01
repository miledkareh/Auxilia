<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class FamilyMember extends Model
{
    use SoftDeletes;
    protected $fillable=['Name','DateOfBirth','family_id'];

    public function family()
{
    return $this->belongsTo(Family::class);
}

public static function insertData($data){

 
      $insertid = DB::table('family_members')->insertGetId($data);
      return $insertid;
   

  }
  public static function insertMemberInfoData($data){

    $insertid = DB::table('member_details')->insertGetId($data);
    return $insertid;
 
}
  public static function updateMemberInfoData($id,$data){
    DB::table('member_details')->where('id', $id)->update($data);
 }
 public static function updateData($id,$data){
  DB::table('family_members')->where('id', $id)->update($data);
}
public static function deleteMemberInfoData($id=0){
  DB::table('member_details')->where('id', '=', $id)->delete();
}
 public static function deleteData($id=0){
    DB::table('family_members')->where('id', '=', $id)->delete();
 }
 public static function getmemberData($id){

    $value=DB::table('family_members')->where('family_id',$id)->where('InHouse',0)->orderBy('id', 'asc')->get(); 
    return $value;

  }

  public static function getmemberInfo($id){

    $value=DB::table('member_details')->where('familymember_id',$id)->orderBy('id', 'asc')->get(); 
    return $value;

  }

  public static function getmemberDataInHouse($id){

    $value=DB::table('family_members')->where('family_id',$id)->where('InHouse',1)->orderBy('id', 'asc')->get(); 
    return $value;

  }
}
