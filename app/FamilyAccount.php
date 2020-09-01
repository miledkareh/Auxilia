<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class FamilyAccount extends Model
{
    use SoftDeletes;
    protected $fillable=['Name','family_id','member_id','Type','Amount','currency_id','Notes','period_id'];

    public static function insertDetail($data){

        $insertid = DB::table('family_accounts')->insertGetId($data);
        return $insertid;
    }

    public static function getResources($id){

        $value=DB::table('family_accounts')->where('family_id',$id)->where('Type','Resource')->orderBy('id', 'asc')->get(); 
        return $value;
    
      }

      public static function getCharges($id){

        $value=DB::table('family_accounts')->where('family_id',$id)->where('Type','Charge')->orderBy('id', 'asc')->get(); 
        return $value;
    
      }

      public static function getChargesByType($id){

        $value=DB::table('charges')->where('Type',$id)->orderBy('Name', 'asc')->get(); 
        return $value;
    
      }
      public static function updateDetail($id,$data){
        DB::table('family_accounts')->where('id', $id)->update($data);
     }
     public static function deleteDetail($id=0){
        DB::table('family_accounts')->where('id', '=', $id)->delete();
      }
}
