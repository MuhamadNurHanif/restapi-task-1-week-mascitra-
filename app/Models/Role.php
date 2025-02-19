<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = ['name', 'slug'];

    /**
     *
     */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            if (empty($role->slug)) {
                $role->slug = Str::slug($role->name); // Auto generate slug
            }
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
