<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'icon'])]
class Amenity extends Model
{
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartment_amenity');
    }
}
