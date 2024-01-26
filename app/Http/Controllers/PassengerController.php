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
    //WORKING with cache commmented because wanted to keep the Spatie filters and  sorting  option
        // $passenger=Cache::get('passenger');
        // if($passenger===null){
        //     $passenger=Passenger::all();
        //     Cache::put('passenger',$passenger,600);
        // }
        // return response()->json(['passengers'=>$passenger]);
        return response()->json(['users' => QueryBuilder::for(Passenger::class)
            ->allowedFilters([
                'first_name',
                'last_name',
                'email',
                AllowedFilter::exact('date_of_birth'),
                AllowedFilter::scope('before_passport_expiring_date')
            ])
            ->allowedSorts(
                'first_name',
                'last_name',
                'email',
                'date_of_birth',
                'passport_expiry_date'
            )
            ->paginate(100)]);
    }
}
