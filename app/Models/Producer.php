<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producer extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'id', 'api_id', 'name', 'img', 'is_popular',
    ];

    public function setImgAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['img'] = $value;
        } else {
            $this->attributes['img'] = Storage::url($value->store('public/producers'));
        }
    }
}
