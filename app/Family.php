<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Family extends Model
{
    use SoftDeletes;
    protected $fillable=['MotherName',
    'Address','Region','Email','Mobile','Phone','SocialHelper','Religion',
    'FamilyName','Date','Street','Place','Building','Floor','RelativeName',
    'LevelOfStudy','DrivingLicense','Car','CompanyName','CompanyLocation','PaymentMode',
    'HealthCare','HomeProperty','NumberOfRooms','LivingRoom','Kitchen','Bathroom','State','Remarks'];

    public function familymembers()
{
    return $this->hasMany(FamilyMember::class);
}
}
