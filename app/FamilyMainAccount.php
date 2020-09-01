<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class FamilyMainAccount extends Model
{
    use SoftDeletes;
    protected $fillable=['family_id','sponsor_id','Amount','currency_id','Notes','cAmount','Date','Type'];

    public static function insertData($data){

        $insertid = DB::table('family_main_accounts')->insertGetId($data);
        return $insertid;
    }

    public static function getData($id){

        $value=DB::table('family_main_accounts')->where('family_id',$id)->orderBy('id', 'asc')->get(); 
        return $value;
    
      }
      public static function getDataDetail($id){

        $value=DB::table('family_main_accounts')->where('id',$id)->orderBy('id', 'asc')->get(); 
        return $value;
    
      }
      public static function updateData($id,$data){
        DB::table('family_main_accounts')->where('id', $id)->update($data);
     }
     public static function deleteData($id=0){
        DB::table('accounts')->where('family_main_account_id', '=', $id)->delete();
        DB::table('family_main_accounts')->where('id', '=', $id)->delete();
      }
}
