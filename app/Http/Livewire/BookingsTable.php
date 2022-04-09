<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Tour;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BookingsTable extends LivewireDatatable
{
    public $exportable = true;
    public $tourID;

    public function builder()
    {
        return Booking::query()
            ->where('tour_id', '=', $this->tourID);
    }

    public function columns()
    {
        return [
            Column::callback(['id'], 'getBookingLink')->label('Last name')->filterable(),
            Column::callback(['id'], 'personCount')->label('Person Count'),
            Column::name('country')->label('Country')->filterable(),
            DateColumn::name('created_at')->label('Registered on')->format('d-m-Y H:i'),
            Column::callback(['id'], 'getStatus')->label('Status'),
        ];
    }

    public function getBookingLink($id, $last_name) {
        $booking = Booking::findOrFail($id);
        return "
            <a class='text-orange-500 bold' href='/booking/$booking->id'>$booking->last_name</a>
        ";
    }

    public function personCount($id)
    {
        $booking = Booking::findOrFail($id);
        return count($booking->travelers);
    }

    public function getStatus($id)
    {
        $booking = Booking::findOrFail($id);
        if($booking->documents_sent === 1) {
            return "<span class='block w-4 h-4 rounded-full bg-red-500'></span>";
        } else if ($booking->completed === 1) {
            return "<span class='block w-4 h-4 rounded-full bg-orange-500'></span>";
        } else {
            return "<span class='block w-4 h-4 rounded-full bg-green-500'></span>";
        }

    }
}