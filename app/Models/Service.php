<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $casts = [
        'endpoint_parameters' => 'json',
        'callback_parameters' => 'json',
    ];
    
    protected $fillable = [
        'slug',
        'application_origin_id',
        'application_destination_id',
        'endpoint_parameters',
        'callback_parameters',
    ];
    
    public function isSync(): Attribute
    {
        return Attribute::get(fn() => true);
    }
    
    public function scopeForIndex(
        Builder $query,
        string $application_origin_id,
        string $application_destination_id,
        string $slug
    ): Builder {
        return $query
            ->where('application_origin_id', $application_origin_id)
            ->where('application_destination_id',$application_destination_id)
            ->where('slug', $slug);
    }
    
    public function transformations(): HasMany
    {
        return $this->hasMany(Transformation::class);
    }
}
