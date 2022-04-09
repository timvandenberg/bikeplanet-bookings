<?php

namespace App\Services;

use App\Models\BookingActions;

class bookingActionsService
{
    public function __construct()
    {
    }

    public function addHistory($booking_id, $action)
    {
        $user = auth()->user();
        $who = '';
        if($user) {
            $who = $user->name;
        }
        $newBookingAction = new BookingActions;
        $newBookingAction->fill([
            'booking_id' => $booking_id,
            'action' => $action,
            'date' => now(),
            'who' => $who,
        ]);
        $newBookingAction->save();
    }

}