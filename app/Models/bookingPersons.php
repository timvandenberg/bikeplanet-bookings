<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingPersons extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the tour.
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Booking');
    }
}