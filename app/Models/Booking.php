<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = [
    //   'tour_id',
    //   'name',
    //   'bike',
    //   'documents',
    //   'completed',
    // ];

    /**
     * Get the tour.
     */
    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }

    public function persons()
    {
        return $this->hasMany('App\Models\Traveler');
    }
}
