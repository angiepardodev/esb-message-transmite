<?php

namespace App\Models;

use App\Casts\JavascriptJsonCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    use HasFactory;
    
    protected $casts = [
        'source_data' => JavascriptJsonCast::class,
        'mapped_data' => JavascriptJsonCast::class,
    ];
    
    protected $fillable = [
        'id',
        'source_data',
        'mapped_data',
    ];
    
}
