<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birth_date'  => 'date:Y-m-d',
    ];

    /**
     * Get the tour.
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Booking');
    }
}
