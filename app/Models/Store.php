<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Store extends Authenticatable
{
    use CrudTrait;
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'description',
        'address',
        'city_id',
        'image',
        'rating',
        'active',
        'firebase_token',
        'last_active',
    ];

    protected $guarded = [
        'password'
    ];

    protected $casts = [
        'last_active' => 'datetime',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(StoreCategory::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function setPasswordAttribute($value) {
        if (!is_null($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setImageAttribute($value) {
        $this->attributes['image'] = Storage::url($value->store('public/stores'));
    }

    public function getProducers(): string
    {
        return implode(', ', Producer::whereIn('api_id', explode(',', $this->category?->producers))->pluck('name')->toArray());
    }

    public function getModels(): string
    {
        return implode(', ', CarModel::whereIn('api_id', explode(',', $this->category?->models))->pluck('name')->toArray());
    }

    public function getParts(): string
    {
        return implode(', ', PartGroup::whereIn('id', explode(',', $this->category?->parts))->pluck('name')->toArray());
    }
}
