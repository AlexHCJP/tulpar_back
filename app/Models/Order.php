<?php

namespace App\Models;

use DateTimeInterface;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable= [
        'title',
        'user_id',
        'car_id',
        'part_id',
        'city_id',
        'comment',
        'status',
        'payment_type',
        'store_id',
        'lat',
        'lon',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function media()
    {
        return $this->morphMany(MediaFiles::class, 'mediable');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'api_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(OrderOffer::class, 'order_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // Фильтр заказов на карте в радиусе
    public function scopeWithinRadius($query, float $lat, float $lon, float $radius)
    {
        $earthRadius = 6371; // Радиус Земли в километрах

        return $query->selectRaw("*,
            ($earthRadius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(lat)) * COS(RADIANS(lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(lat)))) AS distance")
            ->whereRaw("($earthRadius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(lat)) * COS(RADIANS(lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(lat)))) <= $radius")
            ->orderBy('distance', 'asc');
    }
}
