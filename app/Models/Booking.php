<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    
    const STATUS_AVAILABLE   = 'available';
    const STATUS_UNAVAILABLE = 'unavailable';

    protected $fillable = [
        'status',
        'check_in',
        'check_out',
        'total_price',
        'user_id',
        'apartment_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'check_in'    => 'date',
            'check_out'   => 'date',
            'total_price' => 'decimal:2', 
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}