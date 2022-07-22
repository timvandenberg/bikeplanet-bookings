<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class sendEmailService
{
    public function __construct()
    {
    }

    public function sendHasRegisterdEmail($newBooking)
    {
        $bookingUrl = url('/').'/booking/'.$newBooking->id;

        try {
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
        } catch (Exception $e) {
            error_log("Caught $e");
        }
    }

    public function sendSendDocumentsEmail($booking, $variant = 'normal')
    {
        $title = $booking->last_name;
        $titleSlug = Str::slug($title, '-');

        $files = [
            storage_path('/app/public/pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date->format('Y-m-d').'/agreement-'.$titleSlug.'.pdf'),
            storage_path('/app/public/pdf/'.$booking->tour->season.'/'.$booking->tour->slug.'-'.$booking->tour->start_date->format('Y-m-d').'/invoice-'.$titleSlug.'.pdf'),
        ];

        try {
            Mail::send('email.guest-documents', [
                'booking' => $booking,
                'variant' => $variant
            ],
                function ($m) use ($booking, $files) {
                    $m->from('info@bikeplanetbooking.com', 'Bikeplanet booking');
                    $m->to($booking->email, $booking->first_name)->subject('Your booking documents');
                    foreach ($files as $file) {
                        $m->attach($file);
                    }
                }
            );
        } catch (Exception $e) {
            error_log("Caught $e");
        }
    }
}