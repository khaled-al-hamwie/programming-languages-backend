<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class experts extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'experts';
    protected $fillable = [
        'expert_id',
        'name',
        'email',
        'password',
        'balance'
    ];
}
