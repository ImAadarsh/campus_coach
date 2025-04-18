<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TrainerAvailability extends Model
{
    public function up()
{
    Schema::create('trainer_availabilities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trainer_id')->constrained();
        $table->date('date');
        $table->timestamps();
        
        $table->index('trainer_id');
        $table->index('date');
    });
}
public function trainer()
{
    return $this->belongsTo(Trainer::class);
}

public function timeSlots()
{
    return $this->hasMany(TimeSlot::class);
}
}
