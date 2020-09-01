<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
    use SoftDeletes;
    protected $fillable=['Dat','Ref','sponsor_id','Type','Debit','cDebit','currency_id','Bank','Notes','PaymentMode'];


public function sponsor()
{
    return $this->belongsTo(Sponsor::class);
}



}
