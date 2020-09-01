<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sponsor extends Model
{
    use SoftDeletes;
    protected $fillable=['Fullname','Address','Address2','Email','Mobile','Phone','Delegue','Coordinateur','Encaisseur','SouhaitsDuDonateur','FirstPaymentDate','PaymentTerm'];

public function accounts()
{
    return $this->hasMany(Account::class);
}

}
