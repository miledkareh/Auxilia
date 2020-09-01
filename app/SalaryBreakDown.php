<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SalaryBreakDown extends Model
{
    use SoftDeletes;
    protected $fillable=['Description','user_id','Amount'];

}
