<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class FamilyFollowup extends Model
{
    use SoftDeletes;
    protected $fillable=['Problem','Solution','family_id','NumberOfVisits','EndOfTherapy','FamilyTherapy','EndOfFamilyTherapy','Psychologist'];

    public static function insertData($data){

        $insertid = DB::table('family_followups')->insertGetId($data);
        return $insertid;
     
    }
    public static function updateData($id,$data){
        DB::table('family_followups')->where('id', $id)->update($data);
     }
     public static function deleteData($id=0){
        DB::table('family_followups')->where('id', '=', $id)->delete();
      }
      public static function getData($id){

        $value=DB::table('family_followups')->where('id',$id)->orderBy('id', 'asc')->get(); 
        return $value;
    
      }
}
