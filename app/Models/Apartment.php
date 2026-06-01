<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Image;
use App\Models\Booking;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'price_night',
        'max_guests',
        'size',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
