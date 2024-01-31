<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Passenger;
use App\Mail\FlightReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class AutoFlightReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-flight-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $currentDateTime = Carbon::now();
        $timeIn24Hours = Carbon::now()->addHours(24);
        $flights = Flight::where('departure_time', '>', $currentDateTime)
            ->where('departure_time', '<=', $timeIn24Hours)
            ->get();

        if ($flights->count() > 0) {
            foreach ($flights as $flight) {
                $flight = Flight::find($flight['id']);
                $passengers = $flight->passengers;
                if ($passengers->count() > 0) {
                    foreach ($passengers as $passenger) {
                        Mail::to($passenger->email)->send(new FlightReminder($passenger, $flight));
                    }
                }
            }
        }
        return 0;
    }
}
