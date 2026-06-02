<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Apartment;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'check_in',
        'check_out',
        'total_price',
        'user_id',
        'apartment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
