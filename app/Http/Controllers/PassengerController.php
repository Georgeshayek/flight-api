<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PassengerController extends Controller
{
    //
    public function index()
    {
    
        $passenger = Cache::remember('passenger', 600, function () {
            return Passenger::all();
        });
        return response()->json(['passengers'=>$passenger]);
        // return response()->json(['users' => QueryBuilder::for(Passenger::class)
        //     ->allowedFilters([
        //         'first_name',
        //         'last_name',
        //         'email',
        //         AllowedFilter::exact('date_of_birth'),
        //         AllowedFilter::scope('before_passport_expiring_date')
        //     ])
        //     ->allowedSorts(
        //         'first_name',
        //         'last_name',
        //         'email',
        //         'date_of_birth',
        //         'passport_expiry_date'
        //     )
        //     ->paginate(100)]);
    }
}
