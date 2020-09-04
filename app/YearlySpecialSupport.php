<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class YearlySpecialSupport extends Model
{
    use SoftDeletes;
    protected $fillable=['Yearr','Amount'];
}
