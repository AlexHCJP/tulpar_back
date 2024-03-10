<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'api_id',
        'name',
        'modelId',
        'modelName',
        'catalogId',
        'parameters',
        'brand',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'modelId', 'api_id');
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'catalogId', 'api_id');
    }
}
