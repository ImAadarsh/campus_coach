<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function timeSlot()
{
    return $this->belongsTo(TimeSlot::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);
}

public function review()
{
    return $this->hasOne(TrainerReview::class);
}
}
