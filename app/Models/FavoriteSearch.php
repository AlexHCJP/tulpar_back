<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'producer_id',
        'model_id',
        'part_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }
    
    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }
}
