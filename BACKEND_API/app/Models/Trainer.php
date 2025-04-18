<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'hero_img',
        'profile_img',
        'short_about',
        'about',
        'designation',
        'email',
        'passcode',
        'mobile',
        'remember_token',
        'user_type'
    ];

    protected $hidden = [
        'passcode',
        'remember_token',
    ];
    
    public function availabilities()
    {
        return $this->hasMany(TrainerAvailability::class);
    }
    
    public function specializations()
    {
        return $this->hasMany(TrainerSpecialization::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(TrainerReview::class);
    }
       // Use passcode instead of password
       public function getAuthPassword()
       {
           return $this->passcode;
       }
}
