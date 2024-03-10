<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class PartGroup extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'api_id',
        'car_id',
        'hasSubgroups',
        'hasParts',
        'name',
        'img',
        'description',
        'parentId',
    ];

    public function childs()
    {
        return $this->hasMany(PartGroup::class, 'parentId', 'api_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PartGroup::class, 'parentId', 'api_id');
    }

    public function setImgAttribute($value)
    {
        if (is_string($value) || $value == null) {
            $this->attributes['img'] = $value;
        } else {
            $this->attributes['img'] = Storage::url($value->store('public/groups'));
        }
    }
}
