<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appo extends Model
{
    use HasFactory;
    protected $table = 'appo';
    protected $fillable = [
        'appointment_id',
        'user_id',
        'expesrt_id',
        'start_time'
    ];
}
