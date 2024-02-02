<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
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
        return response()->json(['passengers' => $passenger]);
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
    public function uploadImage(Passenger $passenger, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image');

            $imagePath = $img->store('images', 'public');
            $imagePath2 = $this->resizeAndStoreImage($img);
            $passenger->update(['image' => $imagePath,'thumbnail' => $imagePath2]);
            
            return response()->json(['message' => 'Image stored successfully']);
        }

        return response()->json(['error' => $passenger]);
    }
    private function resizeAndStoreImage($imageFile)
    {

        $imagePath = $imageFile->store('images/thumbnail', 'public');

        $image = Image::make(storage_path('app/public/' . $imagePath));
        $image->resize(300, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('app/public/' . $imagePath));
        //to store image in s3
        //$uploadedPath = Storage::disk('s3')->put('images/' . $imagePath, file_get_contents(storage_path('app/public/' . $imagePath)));
        //unlink(storage_path('app/public/' . $imagePath));
        //return $uploadedPath;
        return $imagePath;
    }

   
}
