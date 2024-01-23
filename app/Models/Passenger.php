<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable=[
        'FirstName',
        'LastName',
        'email',
        'password',
        'DOB',
        'passport_expiry_date'
    ];
    public function flights(){
        return $this->belongsToMany(Flight::class,'passenger_flight','passenger_id','flight_id');
    }
}
