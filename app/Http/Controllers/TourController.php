<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourRequest;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class TourController extends Controller
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
        return view('tours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {
        $allInput = $request->all();
        $slug = Str::slug($allInput['title'], '-');

        $tour = new Tour;
        $tour->fill($allInput);
        $tour->fill(['slug' => $slug]);
        $tour->save();

        $path = storage_path('/app/public/pdf/'.$allInput['season'].'/'.$slug.'-'.$allInput['start_date']);
        File::makeDirectory($path, 0777, true, true);

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $cancelledBookings = Booking::where('tour_id', '=', $tour->id)
            ->where('active', '=', 0)
            ->get();

        return view('tours.show', [
            'tour' => $tour,
            'bookings' => $tour->bookings,
            'cancelled' => $cancelledBookings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        return view('tours.edit', [
            'tour' => $tour
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTourRequest $request, Tour $tour)
    {
        $allInput = $request->all();
        $slug = Str::slug($allInput['title'], '-');

        $tour->fill($allInput)->save();
        $tour->fill(['slug' => $slug])->save();

        return redirect(route('tours.show', $tour));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }

    /**
     * export
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function export($tourID)
    {
        $tour = Tour::with('bookings')->where('id', $tourID)->first();

        $fileName = $tour->slug.'-'.$tour->season.'.csv';
        $path = storage_path('/app/exports/');

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array(
            'Booking id', 'Fist name', 'Last name', 'Bike', 'Height', 'Diet', 'Diet remarks', 'Cabin', 'Birthdate', 'Email', 'Phone', 'Street', 'Postal code',
            'Town', 'Country', 'Extra Comments'
        );

        $file = fopen($path . $fileName, 'w');
        fputcsv($file, $columns);

        foreach ($tour->bookings as $booking) {
//            fputcsv($file, array(
//                $booking->id,
//                $booking->first_name,
//                $booking->last_name,
//                $booking->birth_date->format('d-m-Y'),
//                $booking->email,
//                $booking->phone,
//                $booking->street,
//                $booking->postal_code,
//                $booking->town,
//                $booking->country,
//                $booking->extra_comments,
//            ));

            if ($booking->travelers) {
                foreach ($booking->travelers as $traveler) {
                    if (! $traveler->first_name) {
                        continue;
                    }

                    fputcsv($file, array(
                        $booking->id,
                        $traveler->first_name,
                        $traveler->last_name,
                        $traveler->bike,
                        $traveler->height,
                        $traveler->diet,
                        $traveler->diet_remarks,
                        $traveler->cabin,
                        $traveler->birth_date->format('d-m-Y'),
                        $traveler->email,
                        $traveler->phone,
                        $traveler->street,
                        $traveler->postal_code,
                        $traveler->town,
                        $traveler->country,
                        $booking->extra_comments
                    ));
                }
            }
        }

        fclose($file);
        return response()->download($path . $fileName,  $fileName, $headers);
    }
}
