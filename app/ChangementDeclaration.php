<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class ChangementDeclaration extends Model
{
    use SoftDeletes;
    protected $fillable=['changement_id','Remarks','Type','Date','family_id'];

    public static function insertData($data){

        $insertid = DB::table('changement_declarations')->insertGetId($data);
        return $insertid;
    }
    public static function updateData($id,$data){
        DB::table('changement_declarations')->where('id', $id)->update($data);
     }
     public static function deleteData($id=0){
        DB::table('changement_declarations')->where('id', '=', $id)->delete();
      }
}
