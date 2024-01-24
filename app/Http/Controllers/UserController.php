<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{   
    
    public function index(){

        return response()->json(['users'=>QueryBuilder::for(User::class)
        ->allowedFilters(['name'])
        ->paginate(100)]);
    }
  
}
