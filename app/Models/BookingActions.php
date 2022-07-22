<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingActions extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date'  => 'date:Y-m-d',
    ];

    /**
     * Get the tour.
     */
    public function booking()
    {
        return $this->belongsTo('App\Models\Booking');
    }
}
