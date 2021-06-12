<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingPersons;
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

        return view('booking.book', [
            'tour' => $tour[0],
            'bookingCount' => $bookingCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $inputCP = $request->only('client_profile');
        $allBookingInput = $request->only(['tour_id','name','email','room']);

        $newBooking = new Booking;
        $newBooking->fill($allBookingInput);
        $newBooking->fill(['documents' => 0]);
        $newBooking->fill(['completed' => 0]);
        $newBooking->save();

        $bookingPersonsTotal = intval($request->input_total_person_count);


        for ($i=1; $i <= $bookingPersonsTotal; $i++) {
            $inputPerson = $request->only(['name_person_'.$i, 'email_person_'.$i,'bike_person_'.$i,'food_person_'.$i]);
            $newBookingPersons = new BookingPersons;
            $newBookingPersons->fill(['booking_id' => $newBooking->id]);
            $newBookingPersons->fill(['name' => $inputPerson['name_person_'.$i]]);
            $newBookingPersons->fill(['email' => $inputPerson['email_person_'.$i]]);
            $newBookingPersons->fill(['bike' => $inputPerson['bike_person_'.$i]]);
            $newBookingPersons->fill(['food' => $inputPerson['food_person_'.$i]]);
            $newBookingPersons->save();
        }

        if (isset($inputCP['client_profile']) && $inputCP['client_profile'] === 'on') {

            return view('auth.register', [
                'bookingID' => $newBooking->id,
                'name' => $allBookingInput['name'],
                'email' => $allBookingInput['email'],
            ]);

        } else {

            return view('booking.thankyou', [
                'tour' => Tour::findOrFail($allBookingInput['tour_id'])
            ]);
        }
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

        $persons = BookingPersons::where('booking_id', '=', $booking->id)
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

                $title = $booking->name;
                $titleSlug = Str::slug($title, '-');
                $price = $request->price;

                $tour = $booking->tour;

                $persons = BookingPersons::where('booking_id', '=', $booking->id)
                    ->get();

                $pdf = PDF::loadView('booking.pdftemplates.invoice', array(
                        'title' => $title,
                        'price' => $price,
                        'tour' => $tour,
                        'person_count' => count($persons)
                    ))
                    // ->setPaper('a4', 'landscape')
                    ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$titleSlug.'.pdf');

                // $pdf = PDF::loadFile(public_path().'/pdf-templates/test-pdf.html')
                //     ->save('pdf/testtttt222.pdf');

                // PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

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
