<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Changement extends Model
{
    use SoftDeletes;
    protected $fillable=['Name','Group1'];
}
