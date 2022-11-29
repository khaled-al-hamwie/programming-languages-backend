<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $primaryKey = 'expert_id';
    protected $fillable = ['name', 'pic', 'phone', 'address', 'openning_time'];
    protected $attributes = [
        'rating' => 0
    ];
    protected $hidden = [
        'pic',
        // 'expert_id'
    ];
    public $timestamps = false;
}
