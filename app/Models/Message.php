<?php

namespace App\Models;

use App\Casts\ChainCast;
use App\Casts\SignalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $appends = [
        'chain',
    ];
    
    protected $fillable = [
        'chain_ref',
        'chain_tenant',
        'service_id',
        'signal',
    ];
    
    protected $casts = [
        'signal' => SignalCast::class,
        'chain'  => ChainCast::class,
    ];
}
