<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();

        /*
        |--------------------------------------------------------------------------
        | Consumer
        |--------------------------------------------------------------------------
        */

        if ($roles[0] === 'client') {

            $bookings = Booking::with('tour')
                ->where('user_id', '=', $user->id)
                ->get();

            return view('home-client', [
                'person' => $user,
                'bookings' => $bookings
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Consumer
        |--------------------------------------------------------------------------
        */

        if ($roles[0] === 'admin') {
            $allTours = Tour::all();

            $tourArray = [];

            foreach ($allTours as $key => $tour) {
                $bookings = $tour->bookings;
                $pending = 0;
                $completed = 0;
                $spotsLeft = $tour->max_bookings;

                foreach ($bookings as $key => $booking) {
                    if ($booking['completed'] === 0) {
                        $pending++;
                    } else if ($booking['completed'] === 1) {
                        $completed++;
                        $spotsLeft--;
                    }
                }

                $tourArray[] = [
                    'id' => $tour->id,
                    'title' => $tour->title,
                    'season' => $tour->season,
                    'pending' => $pending,
                    'completed' => $completed,
                    'spots_left' => $spotsLeft,
                    'start_date' => $tour->start_date,
                ];
            }

            return view('home', [
                'tours' => $tourArray
            ]);
        }
    }
}
