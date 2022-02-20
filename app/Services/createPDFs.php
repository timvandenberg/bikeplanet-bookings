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
        $booking->update([
            'documents' => 1,
            'price' => $request->price,
            'discount' => $request->discount
        ]);

        $this->primmadonnaPDFs($booking);
    }

    private function primmadonnaPDFs($booking) {

        $travelers = Traveler::where('booking_id', '=', $booking->id)
            ->get();

        $bookedTour = Tour::where('id', '=', $booking->tour_id)
            ->first();

        $title = $booking->last_name;
        $titleSlug = Str::slug($title, '-');
        $price = $booking->price;

        $pdf = PDF::loadView('booking.pdftemplates.'.$bookedTour->tour_type.'.agreement', array(
            'booking' => $booking,
            'travelers' => $travelers,
            'tour' => $bookedTour
        ))
            ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/agreement-'.$titleSlug.'.pdf');

//        return $pdf->stream();

        $pdf = PDF::loadView('booking.pdftemplates.'.$bookedTour->tour_type.'.invoice', array(
            'booking' => $booking,
            'travelers' => $travelers,
            'tour' => $bookedTour
        ))
            ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/invoice-'.$titleSlug.'.pdf');

//        $ebikeCount = 0;
//        $hybridCount = 0;
//        $noCount = 0;
//        $vegetarianCount = 0;
//        $veganCount = 0;
//        foreach ($travelers as $traveler) {
//            if ($traveler->bike === 'e-bike') {
//                $ebikeCount++;
//            }
//            if ($traveler->bike === 'hybrid-bike') {
//                $hybridCount++;
//            }
//            if ($traveler->bike === 'no-bike') {
//                $noCount++;
//            }
//            if ($traveler->diet === 'vegetarian') {
//                $vegetarianCount++;
//            }
//            if ($traveler->diet === 'vegan') {
//                $veganCount++;
//            }
//        }
//
//        $pdf = PDF::loadView('booking.pdftemplates.'.$bookedTour->tour_type.'.invoice', array(
//            'title' => $title,
//            'price' => $price,
//            'person_count' => count($travelers),
//            'tour' => $bookedTour,
//            'date' => '10-01-2021',
//            'ebikeCount' => $ebikeCount,
//            'hybridCount' => $hybridCount,
//            'noCount' => $noCount,
//            'vegetarianCount' => $vegetarianCount,
//            'veganCount' => $veganCount
//        ))
//            ->save('pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date.'/invoice-'.$titleSlug.'.pdf');

        // return $pdf->stream();

    }
}
