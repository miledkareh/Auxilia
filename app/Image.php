<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Image extends Model
{
    use SoftDeletes;
    protected $fillable=['Name','tablename','tableserial'];

    public static function getData($id,$table){

        $value=DB::table('images')->where('tableserial',$id)->where('tablename',$table)->orderBy('id', 'asc')->get(); 
        return $value;
    
      }
}
