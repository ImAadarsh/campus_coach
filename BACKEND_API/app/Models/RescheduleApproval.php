<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescheduleApproval extends Model
{
    protected $fillable = [
        'reschedule_request_id',
        'approved_by_id',
        'approved_by_type',
        'new_time_slot_id',
        'notes'
    ];
    
    public function rescheduleRequest()
    {
        return $this->belongsTo(RescheduleRequest::class);
    }
    
    public function newTimeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'new_time_slot_id');
    }
}
