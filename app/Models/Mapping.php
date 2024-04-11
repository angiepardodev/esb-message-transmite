<?php

namespace App\Models;

use App\Casts\JsonWithMissing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    use HasFactory;
    
    protected $casts = [
        'source_data' => JsonWithMissing::class,
        'mapped_data' => JsonWithMissing::class,
    ];
    
    protected $fillable = [
        'id',
        'source_data',
        'mapped_data',
    ];
    
}
