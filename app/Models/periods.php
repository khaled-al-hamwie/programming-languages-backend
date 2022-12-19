<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periods extends Model
{
    use HasFactory;
    protected $table = 'periods';
    protected $fillable = [
        'period_id',
        'day_id',
        'start',
        'status',
        'expert_id'
    ];
}
