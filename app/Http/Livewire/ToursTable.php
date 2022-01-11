<?php

namespace App\Http\Livewire;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Tour;

class ToursTable extends LivewireDatatable
{
    public function builder()
    {
//        return Tour::query()
//            ->leftJoin('bookings', 'bookings.id', 'tour.bookings');
    }

    public function columns()
    {
//        return [
//            Column::checkbox(),
//            Column::name('title')
//                ->label('Title')
//                ->filterable()
//                ->linkTo('tour', 1),
//            Column::name('start_date')->label('Start Date')->filterable(),
//            Column::name('tour.bookings.pending')->label('Pending')->filterable(),
//            Column::callback(['tour.bookings'], function ($bookings) {
//                $test = 'test';
//                return $test;
//            })->label('Pending')->filterable(),

//            Column::name('completed')->label('Booking completed')->filterable(),
//            Column::name('spots_left')->label('Spots Left')->filterable(),
//        ];
    }
}