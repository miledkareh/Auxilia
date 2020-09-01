<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserAccount extends Model
{
    protected $fillable = [
        'Description', 'Debit', 'Credit','cDebit','cCredit','user_id'
    ];
}
