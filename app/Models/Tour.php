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

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
