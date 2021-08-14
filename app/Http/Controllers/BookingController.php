<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Traveler;
use App\Models\Tour;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        // dd($slug);
        $tour = Tour::with('bookings')
            ->where('slug', '=', $slug)
            ->where('season', '=', $season)
            ->get();

        $bookings = Booking::with('persons')
            ->where('tour_id', '=', $tour[0]->id)
            ->where('active', '=', 1)
            ->get();

        $bookingCount = count($bookings);

        return view('booking.book-part1', [
            'tour' => $tour[0],
            'bookingCount' => $bookingCount
        ]);
    }

    /**
     * step1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function part1(Request $request)
    {
        $request->validate([
            'tour_id' => 'required',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        // dd($request->all());

        $request->session()->put('key', 'value');
        $request->session()->push('allPart1', $request->all());

        return view('booking.book-part2', [
            'first_name_1' => $request->first_name,
            'last_name_1' => $request->last_name,
            'email_1' => $request->email,
            'phone_1' => $request->phone,
            'street_1' => $request->street,
            'postal_code_1' => $request->postal_code,
            'town_1' => $request->town,
            'country_1' => $request->country,
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
        $request->session()->push('allPart2', $request->all());

        return view('booking.book-part3');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allPart1 = $request->session()->all()['allPart1'][array_key_last($request->session()->all()['allPart1'])];
        $allPart2 = $request->session()->all()['allPart2'][array_key_last($request->session()->all()['allPart2'])];

        $newBooking = new Booking;
        $newBooking->fill($allPart1);
        $newBooking->fill(['documents' => 0]);
        $newBooking->fill(['completed' => 0]);
        $newBooking->save();

        $TravelerTotal = intval($allPart2['input_total_person_count']);

        for ($i=1; $i <= $TravelerTotal; $i++) {
            $newTraveler = new Traveler;
            $newTraveler->fill(['booking_id' => $newBooking->id]);
            $newTraveler->fill(['first_name' => $allPart2['first_name_person_'.$i]]);
            $newTraveler->fill(['last_name' => $allPart2['last_name_person_'.$i]]);
            $newTraveler->fill(['email' => $allPart2['email_person_'.$i]]);
            $newTraveler->fill(['phone' => $allPart2['phone_person_'.$i]]);
            $newTraveler->fill(['street' => $allPart2['street_person_'.$i]]);
            $newTraveler->fill(['postal_code' => $allPart2['postal_code_person_'.$i]]);
            $newTraveler->fill(['town' => $allPart2['town_person_'.$i]]);
            $newTraveler->fill(['country' => $allPart2['country_person_'.$i]]);
            $newTraveler->fill(['bike' => $allPart2['bike_person_'.$i]]);
            $newTraveler->fill(['height' => $allPart2['height_person_'.$i]]);
            $newTraveler->fill(['food' => $allPart2['food_person_'.$i]]);
            if($i%2===1) {
                $newTraveler->fill(['cabin' => $allPart2['cabin_person_'.$i]]);
            } else {
                $newTraveler->fill(['cabin' => $allPart2['coupled_cabin_person_'.$i]]);
            }
            $newTraveler->save();
        }

        $travelers = Traveler::where('booking_id', '=', $newBooking->id)
            ->get();

        return view('booking.thankyou', [
            'tour' => Tour::findOrFail($allPart1['tour_id']),
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
            ->get();

        $user = auth()->user();

        $titleSlug = Str::slug($bookingTour[0]->name, '-');

        $persons = Traveler::where('booking_id', '=', $booking->id)
            ->get();

        return view('booking.show', [
            'booking' => $bookingTour[0],
            'user_role' => $user->roles[0]->name,
            'titleSlug' => $titleSlug,
            'persons' => $persons
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
            if ($allInput['update-type'] === 'send-documents') {

                $request->validate([ 'price' => 'required', ]);
                $booking->update([
                    'documents' => 1,
                    'price' => $request->price,
                ]);

                $title = $booking->last_name;
                $titleSlug = Str::slug($title, '-');
                $price = $request->price;
                $tour = $booking->tour;

                $travelers = Traveler::where('booking_id', '=', $booking->id)
                    ->get();

                $bookedTour = Tour::where('id', '=', $booking->tour_id)
                    ->first();

                // dd($bookedTour);

                $pdf = PDF::loadView('booking.pdftemplates.agreement', array(
                        'title' => $title,
                        'price' => $price,
                        'tour' => $tour,
                        'person_count' => count($travelers),
                        'tour' => $bookedTour
                    ))
                    ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/'.$titleSlug.'-agreement.pdf');

                // return $pdf->stream();

                $pdf = PDF::loadView('booking.pdftemplates.invoice', array(
                        'title' => $title,
                        'price' => $price,
                        'tour' => $tour,
                        'person_count' => count($travelers),
                        'tour' => $bookedTour,
                        'date' => '10-01-2021'
                    ))
                    ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/'.$titleSlug.'.pdf');

                // return $pdf->stream();
            }

            if ($allInput['update-type'] === 'send-documents-again') {
                $booking->update([
                    'documents' => 0,
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
