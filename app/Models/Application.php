<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'url',
    ];
    
    protected $appends = [
        'is_chain_sharing_allowed',
    ];
    
    public function id(): Attribute
    {
        return Attribute::make(
            fn() => $this->attributes['id'] ?? null,
            fn($value) => $this->attributes['id'] = $value
        );
    }
    
    public function isChainSharingAllowed(): Attribute
    {
        return Attribute::get(fn() => true);
    }
}
