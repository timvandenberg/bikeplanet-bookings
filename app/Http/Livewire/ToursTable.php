<?php
namespace App\Http\Livewire;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Tour;

class ToursTable extends LivewireDatatable
{
//    public $exportable = true;

    public function builder()
    {
        return Tour::query();
    }

    public function columns()
    {
        return [
//            Column::checkbox(),
            Column::callback(['id', 'title'], 'getTourLink')->label('Title')->filterable(),
            Column::name('season')->label('Season')->filterable(),
            Column::name('tour_type')->label('Type')->filterable(),
            DateColumn::name('start_date')->label('Start Date')->format('d-m-Y'),
            Column::callback(['id'],'getPending' )->label('Pending'),
            Column::callback(['id'], 'getBooked')->label('Booked'),
            Column::callback(['id'], 'getSpotsLeft')->label('Booked')
        ];
    }

    public function getTourLink($id) {
        $tour = Tour::findOrFail($id);

        return "
            <a href='/tours/$tour->id' class='text-orange-500 bold'>$tour->title</a>
        ";
    }

    public function getPending($id) {
        $tour = Tour::findOrFail($id);
        $bookings = $tour->bookings;
        $pending = 0;
        foreach ($bookings as $key => $booking) {
            if ($booking['completed'] === 0) {
                $pending++;
            }
        }
        return $pending;
    }

    public function getBooked($id) {
        $tour = Tour::findOrFail($id);
        $bookings = $tour->bookings;
        $completed = 0;
        foreach ($bookings as $key => $booking) {
            if ($booking['completed'] === 1) {
                $completed++;
            }
        }
        return $completed;
    }

    public function getSpotsLeft($id) {
        $tour = Tour::findOrFail($id);
        $bookings = $tour->bookings;
        $spotsLeft = $tour->max_bookings;
        foreach ($bookings as $key => $booking) {
            if ($booking['completed'] === 1) {
                $spotsLeft--;
            }
        }
        return $spotsLeft;
    }
}