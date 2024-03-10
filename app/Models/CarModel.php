<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CarModel extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'id', 'api_id', 'name', 'producer_id', 'img'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class, 'producer_id', 'api_id');
    }

    public function setImgAttribute($value)
    {
        if (is_string($value) || $value == null) {
            $this->attributes['img'] = $value;
        } else {
            $this->attributes['img'] = Storage::url($value->store('public/cars'));
        }
    }
}
