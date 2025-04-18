<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    public function trainerAvailability()
{
    return $this->belongsTo(TrainerAvailability::class);
}
public function booking()
{
    return $this->hasOne(Booking::class);
}
}
