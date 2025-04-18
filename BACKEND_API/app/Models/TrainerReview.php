<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerReview extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function trainer()
{
    return $this->belongsTo(Trainer::class);
}

public function booking()
{
    return $this->belongsTo(Booking::class);
}
}
