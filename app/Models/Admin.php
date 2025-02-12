<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, HasUuids;

    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
}
