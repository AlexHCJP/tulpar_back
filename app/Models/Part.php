<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Part extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'number',
        'notice',
        'description',
        'positionNumber',
        'url',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(PartGroup::class, 'group_id', 'api_id');
    }
}
