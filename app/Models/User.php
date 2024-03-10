<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'verified_at',
        'password',
        'firebase_token',
        'firebase_uid',
        'role',
        'image',
        'last_active',
    ];

    protected $hidden = [
        'password',
        'firebase_token',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'last_active' => 'datetime',
    ];

    public function setPasswordAttribute($value) {
        if (!is_null($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setImageAttribute($value) {
        $this->attributes['image'] = Storage::url($value->store('public/users'));
    }
}
