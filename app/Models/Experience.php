<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $primaryKey = 'experience_id';
    protected $fillable = ['name', 'expert_id', 'details', 'is_private'];
    protected $attributes = [
        'is_private' => false
    ];
    protected $hidden = [
        'experience_id'
    ];
    public $timestamps = false;
}
