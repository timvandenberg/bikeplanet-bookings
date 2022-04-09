<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingActions;
use App\Models\Traveler;
use App\Models\Tour;
use App\Services\bookingActionsService;
use App\Services\bookingService;
use App\Services\sendEmailService;
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

        $bookingService = new bookingService();
        $newBooking = $bookingService->saveBooking($request);

        $travelers = Traveler::where('booking_id', '=', $newBooking->id)
            ->get();

        $sendEmailService = new sendEmailService();
        $sendEmailService->sendHasRegisterdEmail($newBooking);

        $tour = Tour::findOrFail($allPart1['tour_id']);

        $bookingActions = new bookingActionsService();
        $bookingActions->addHistory($newBooking->id, 'Client Registered');

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
        $bookingActions = BookingActions::where('booking_id', '=', $booking->id)->get();

        return view('booking.show', [
            'booking' => $bookingTour,
            'titleSlug' => $titleSlug,
            'travelers' => $travelers,
            'bookingActions' => $bookingActions
        ]);
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
            $bookingService = new bookingService();
            $bookingService->updateBooking($allInput, $request, $booking);
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
