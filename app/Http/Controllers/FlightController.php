<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class FlightController extends Controller
{
    //
    public function index(){

        return response()->json(['flights'=>QueryBuilder::for(Flight::class)
        ->allowedFilters([AllowedFilter::exact('id'),
                            AllowedFilter::exact('number'),
                            AllowedFilter::scope('starts_before'),
                            AllowedFilter::scope('arrives_before'),
                            'arrival_city',
                            'departure_city'])
        ->allowedSorts( 
                        'departure_city',
                        'arrival_city',
                        'departure_time',
                        'arrival_time')
        ->paginate(100)]);
        
    }
    public function show(Flight $flight){
        //return all users that belong to the flight passed by parameter.
        return response()->json(['users'=>Flight::find($flight->id)->passengers()->paginate(5)]);
    }
}
