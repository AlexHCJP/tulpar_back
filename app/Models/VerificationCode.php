<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'code'
    ];
    
}
