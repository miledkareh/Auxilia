<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class AcademicInfo extends Model
{
    use SoftDeletes;
    protected $fillable=['Actual','New','Average','Remarks','familymember_id'];

    public static function insertData($data){
        $insertid = DB::table('academic_infos')->insertGetId($data);
        return $insertid;
    }
    public static function updateData($id,$data){
        DB::table('academic_infos')->where('id', $id)->update($data);
     }
     public static function deleteData($id=0){
        DB::table('academic_infos')->where('id', '=', $id)->delete();
      }
      public static function getData($id){

        $value=DB::table('academic_infos')->where('familymember_id',$id)->orderBy('id', 'asc')->get(); 
        return $value;
    
      }
}
