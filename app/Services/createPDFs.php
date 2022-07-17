<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\Traveler;
use Illuminate\Support\Str;
use PDF;

class createPDFs
{
    public function __construct($request, $booking)
    {
        $this->checkDiscountAndSetPrice($request, $booking);
        $this->makePDFs($booking);
    }

    private function checkDiscountAndSetPrice($request, $booking) {
        $bookedTour = Tour::where('id', '=', $booking->tour_id)
            ->first();

        $travelers = Traveler::where('booking_id', '=', $booking->id)
            ->get();

        $travelerCount = count($travelers);
        $bookingPrice = $travelerCount * $bookedTour->price;
        $finalPrice = $bookingPrice;
        $bikePrice = 0;
        foreach($travelers as $traveler) {
            if($traveler->bike === 'e-bike') {
                $bikePrice += 100;
            }
        }
        $finalPrice += $bikePrice;

        if($request->discount) {
            $finalPrice -= (int)$request->discount;
        }

        $booking->update([
            'documents' => 1,
            'price' => $finalPrice,
            'discount' => $request->discount
        ]);
    }

    private function makePDFs($booking) {
        $travelers = Traveler::where('booking_id', '=', $booking->id)
            ->get();

        $bookedTour = Tour::where('id', '=', $booking->tour_id)
            ->first();

        $title = $booking->last_name;
        $titleSlug = Str::slug($title, '-');

        PDF::loadView('booking.pdftemplates.'.$bookedTour->tour_type.'.agreement', array(
            'booking' => $booking,
            'travelers' => $travelers,
            'tour' => $bookedTour
        ))->save(storage_path('/app/public/pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date->format('Y-m-d').'/agreement-'.$titleSlug.'.pdf'));

        PDF::loadView('booking.pdftemplates.'.$bookedTour->tour_type.'.invoice', array(
            'booking' => $booking,
            'travelers' => $travelers,
            'tour' => $bookedTour
        ))->save(storage_path('/app/public/pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date->format('Y-m-d').'/invoice-'.$titleSlug.'.pdf'));
    }
}
