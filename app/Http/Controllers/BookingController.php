<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Traveler;
use App\Models\Tour;
use App\Services\createPDFs;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create', [
        ]);
    }

    /**
     * book
     *
     * @return \Illuminate\Http\Response
     */

    public function book(Tour $tour, $season, $slug)
    {
        $tour = Tour::with('bookings')
            ->where('slug', '=', $slug)
            ->where('season', '=', $season)
            ->first();

        if(!$tour) {
            return view('404');
        }

        $bookingCount = count($tour->bookings);

        return view('booking.book-part1', [
            'tour' => $tour,
            'bookingCount' => $bookingCount,
            'referralCode' => true
        ]);
    }

    /**
     * step1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function part2(Request $request)
    {
        $request->validate([
            'tour_id' => 'required',
            'referral_code' => 'required',
        ]);

        $tour = Tour::with('bookings')
            ->where('id', $request->tour_id)
            ->first();

        if ($request->referral_code !== $tour->referral_code) {
            $bookingCount = count($tour->bookings);
            return view('booking.book-part1', [
                'tour' => $tour,
                'bookingCount' => $bookingCount,
                'referralCode' => false
            ]);
        }

        return view('booking.book-part2', [
            'tour' => $tour
        ]);
    }

    /**
     * step2
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function part3(Request $request)
    {
        $request->validate([
            'tour_id' => 'required',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $tour = Tour::where('id', $request->tour_id)->first();

        $request->session()->put('key', 'value');
        $request->session()->push('allPart2', $request->all());

        return view('booking.book-part3', [
            'tour' => $tour,
            'first_name_1' => $request->first_name,
            'last_name_1' => $request->last_name,
            'birth_date_1' => $request->birth_date,
            'email_1' => $request->email,
            'phone_1' => $request->phone,
            'street_1' => $request->street,
            'postal_code_1' => $request->postal_code,
            'town_1' => $request->town,
            'country_1' => $request->country,
        ]);
    }

    /**
     * step3
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function part4(Request $request)
    {
        $request->session()->push('allPart3', $request->all());

        return view('booking.book-part4');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allPart1 = $request->session()->all()['allPart2'][array_key_last($request->session()->all()['allPart2'])];
        $allPart2 = $request->session()->all()['allPart3'][array_key_last($request->session()->all()['allPart3'])];
        $allPart3 = $request->all();

        $newBooking = new Booking;
        $newBooking->fill($allPart1);
        $newBooking->fill(['input_total_person_count' => $allPart2['input_total_person_count']]);
        $newBooking->fill($allPart3);
        $newBooking->fill(['documents' => 0]);
        $newBooking->fill(['documents_sent' => 0]);
        $newBooking->fill(['completed' => 0]);
        $newBooking->save();

        $TravelerTotal = intval($allPart2['input_total_person_count']);

        for ($i=1; $i <= $TravelerTotal; $i++) {
            $newTraveler = new Traveler;
            $newTraveler->fill(['booking_id' => $newBooking->id]);
            $newTraveler->fill(['first_name' => $allPart2['first_name_person_'.$i]]);
            $newTraveler->fill(['last_name' => $allPart2['last_name_person_'.$i]]);
            $newTraveler->fill(['birth_date' => $allPart2['birth_date_person_'.$i]]);
            $newTraveler->fill(['email' => $allPart2['email_person_'.$i]]);
            $newTraveler->fill(['phone' => $allPart2['phone_person_'.$i]]);
            $newTraveler->fill(['bike' => $allPart2['bike_person_'.$i]]);
            $newTraveler->fill(['height' => $allPart2['height_person_'.$i]]);
            $newTraveler->fill(['diet' => $allPart2['diet_person_'.$i]]);
            $newTraveler->fill(['diet_remarks' => $allPart2['diet_remarks_person_'.$i]]);


            // set same address as person -1
            if(($i === 2 || $i === 4 || $i === 6 || $i === 8) && !isset($allPart2['different_address_'.$i])) {
                $newTraveler->fill(['street' => $allPart2['street_person_'.($i-1)]]);
                $newTraveler->fill(['postal_code' => $allPart2['postal_code_person_'.($i-1)]]);
                $newTraveler->fill(['town' => $allPart2['town_person_'.($i-1)]]);
                $newTraveler->fill(['country' => $allPart2['country_person_'.($i-1)]]);
            } else { // set different address
                $newTraveler->fill(['street' => $allPart2['street_person_'.$i]]);
                $newTraveler->fill(['postal_code' => $allPart2['postal_code_person_'.$i]]);
                $newTraveler->fill(['town' => $allPart2['town_person_'.$i]]);
                $newTraveler->fill(['country' => $allPart2['country_person_'.$i]]);
            }

            if($i%2===1) {
                $newTraveler->fill(['cabin' => $allPart2['cabin_person_'.$i]]);
            } else {
                $newTraveler->fill(['cabin' => $allPart2['coupled_cabin_person_'.$i]]);
            }

            $newTraveler->save();
        }

        $travelers = Traveler::where('booking_id', '=', $newBooking->id)
            ->get();

        $bookingUrl = url('/').'/booking/'.$newBooking->id;

        Mail::send('email.admin-new-booking', [
            'booking' => $newBooking,
            'bookingUrl' => $bookingUrl,
            'tourTitle' => $newBooking->tour->title
        ], function ($m) use ($newBooking) {
            $m->from('info@bikeplanetbooking.com', 'Bikeplanet Booking');
            $m->to('bikeplanettours@gmail.com', 'Lenny')->subject('New booking for '.$newBooking->tour->title);
        });

        Mail::send('email.guest-new-booking', ['booking' => $newBooking], function ($m) use ($newBooking) {
            $m->from('info@bikeplanetbooking.com', 'Bikeplanet Booking');
            $m->to($newBooking->email, $newBooking->first_name)->subject('Thankyou for booking with us');
        });

        $tour = Tour::findOrFail($allPart1['tour_id']);
        if(!$tour) {
            dd('no tour found');
        }

        return view('booking.thankyou', [
            'tour' => $tour,
            'booking' => $allPart1,
            'travelers' => $travelers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $bookingTour = Booking::with('tour')
            ->where('id', '=', $booking->id)
            ->first();

        $titleSlug = Str::slug($bookingTour->name, '-');

        $travelers = $bookingTour->travelers;

        $user = auth()->user();
        $userRole = $user->roles[0]->name;
        if(!$userRole) {
            dd('no role');
        }

        return view('booking.show', [
            'booking' => $bookingTour,
            'user_role' => $userRole,
            'titleSlug' => $titleSlug,
            'travelers' => $travelers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        if ($allInput = $request->all()) {
            if ($allInput['update-type'] === 'create-documents') {
//                $request->validate([ 'price' => 'required', ]);
                new createPDFs($request, $booking);
            }

            if ($allInput['update-type'] === 'create-documents-again') {
                $booking->update([
                    'documents' => 0,
                ]);
            }

            if ($allInput['update-type'] === 'send-documents') {
                $title = $booking->last_name;
                $titleSlug = Str::slug($title, '-');

                $files = [
                    public_path('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/agreement-'.$titleSlug.'.pdf'),
                    public_path('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/invoice-'.$titleSlug.'.pdf'),
                ];

                Mail::send('email.guest-documents', ['booking' => $booking],
                    function ($m) use ($booking, $files) {
                        $m->from('info@bikeplanetbooking.com', 'Bikeplanet booking');
                        $m->to($booking->email, $booking->first_name)->subject('Your booking documents');
                        foreach ($files as $file) {
                            $m->attach($file);
                    }
                });

                 $booking->update([
                     'documents_sent' => 1,
                 ]);
            }

            if ($allInput['update-type'] === 'has-payed') {
                $booking->update([
                    'completed' => 1,
                ]);
            }

            if ($allInput['update-type'] === 'cancel_booking') {
                $booking->update([
                    'active' => 0,
                ]);
            }
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $tourID = $booking->tour_id;
        $booking->delete();

        $tour = Tour::findOrFail($tourID);

        return redirect(route('tours.show', $tour));

    }
}
