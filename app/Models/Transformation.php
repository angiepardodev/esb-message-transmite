<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transformation extends Model
{
    use HasFactory;
    
    public function mapping(): Attribute
    {
        return Attribute::make(get: fn() => $this->mappings()->first());
    }
    
    public function mappings(): BelongsToMany
    {
        return $this->belongsToMany(Mapping::class)->using(MappingTransformation::class);
    }
}
