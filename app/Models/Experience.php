<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Experience extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $primaryKey = 'experience_id';
    protected $fillable = ['name', 'details', 'is_private', 'expert_id'];

    protected $attributes = [
        'is_private' => false,
    ];
    // protected $hidden = [
    //     'experience_id'
    // ];
    public $timestamps = false;
    public function expert()
    {
        return $this->belongsTo(Expert::class, 'expert_id');
    }
}
