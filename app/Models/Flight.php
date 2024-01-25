<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time'
    ];
    protected $guarded = [];
    public function passengers(): BelongsToMany
    {

        return $this->belongsToMany(Passenger::class);
    }
    public function scopeStartsBefore(Builder $query, $date): Builder
    {
        return $query->where('departure_time', '<=', Carbon::parse($date));
    }
    public function scopeArrivesBefore(Builder $query, $date): Builder
    {
        return $query->where('arrival_time', '<=', Carbon::parse($date));
    }
}
