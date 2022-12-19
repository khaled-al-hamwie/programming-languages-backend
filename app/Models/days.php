<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class days extends Model
{
    use HasFactory;
    protected $table = 'days';
    protected $fillable = [
        'day_id',
        'expert_id',
        'day',
        'start_time',
        'end_time'
    ];
}
