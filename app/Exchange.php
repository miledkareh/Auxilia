<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Exchange extends Model
{
    use SoftDeletes;
    protected $fillable=['Dat','FromCurrency','ToCurrency','FromAmount','ToAmount'];
}
