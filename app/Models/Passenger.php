<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'passport_expiry_date'
    ];
    protected $guarded=[];
    public function flights(): BelongsToMany{
        return $this->belongsToMany(Flight::class);
    }
    // filtering for passport expiring date {
    public function scopeBeforePassportExpiringDate(Builder $query, $date): Builder
    {
        return $query->where('passport_expiry_date', '<=', Carbon::parse($date));
    }
}
