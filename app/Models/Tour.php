<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = [
    //   'title',
    //   'slug',
    //   'season',
    //   'price',
    // ];

    protected $casts = [
        'start_date'  => 'date:Y-m-d',
        'end_date'  => 'date:Y-m-d'
    ];

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
