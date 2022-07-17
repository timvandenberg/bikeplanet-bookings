<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Traveler;

class bookingService
{
    public function __construct()
    {
    }

    public function saveBooking($request)
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

        return $newBooking;
    }

    public function updateBooking($allInput, $request, $booking)
    {
        $bookingActions = new bookingActionsService();

        switch($allInput['update-type'])
        {
            case 'create-documents';
                new createPDFs($request, $booking);
                $bookingActions->addHistory($booking->id, 'Create Documents');
                break;
            case 'create-documents-again';
                $booking->update(['documents' => 0,]);
                break;
            case 'send-documents';
                $sendEmailService = new sendEmailService();
                $sendEmailService->sendSendDocumentsEmail($booking);
                $booking->update(['documents_sent' => 1,]);
                $bookingActions->addHistory($booking->id, 'Send Documents');
                break;
            case 'has-payed';
                $booking->update(['completed' => 1]);
                $bookingActions->addHistory($booking->id, 'Mark as payed');
                break;
            case 'cancel_booking';
                $booking->update(['active' => 0]);
                $bookingActions->addHistory($booking->id, 'Booking Canceled');
                break;
            case 'activate_booking';
                $booking->update(['active' => 1]);
                $bookingActions->addHistory($booking->id, 'Booking Activated');
                break;
        }
    }
}