<?php

namespace App\Http\Controllers;

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
        return view('tours.create', [
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
            'title' => 'required',
            'price' => 'required',
            'season' => 'required',
            'max_bookings' => 'required',
            'tour_type' => 'required'
        ]);

        $allInput = $request->all();
        $slug = Str::slug($allInput['title'], '-');

        $tour = new Tour;
        $tour->fill($allInput);
        $tour->fill(['slug' => $slug]);
        $tour->save();

        $path = public_path().'/pdf/2021/'.$slug.'-'.$allInput['start_date'];
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

        // dd($cancelledBookings);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'season' => 'required',
            'max_bookings' => 'required',
            'tour_type' => 'required'
        ]);

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
        $tour = Tour::where('id', $tourID)->first();
        dd($tour->bookings);
    }
}
