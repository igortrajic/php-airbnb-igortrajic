<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Apartment;


#[Fillable(['status', 'check_in', 'check_out', 'total_price', 'id_user', 'apartment_id'])]

class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
