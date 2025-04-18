<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescheduleRequest extends Model
{
    protected $fillable = [
        'booking_id',
        'preferred_date',
        'preferred_time',
        'reason',
        'status'
    ];
    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    public function approval()
    {
        return $this->hasOne(RescheduleApproval::class);
    }
}
