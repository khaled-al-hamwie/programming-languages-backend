<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Expert extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $primaryKey = 'expert_id';
    protected $fillable = ['name', 'pic', 'phone', 'address', 'openning_time', 'category_id', 'email', 'password', 'balance'];
    protected $attributes = [
        'rating' => 0,
        // 'experiences' => $this->experiences
    ];
    protected $hidden = [
        'pic',
        'password'
        // 'expert_id'
    ];
    public $timestamps = false;

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'expert_id')->where('is_private', 0);
    }
}
