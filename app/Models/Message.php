<?php

namespace App\Models;

use App\Casts\ChainCast;
use App\Casts\SignalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'completed_at',
    ];
    
    protected $casts = [
        'signal' => SignalCast::class,
        'chain'  => ChainCast::class,
    ];
    
    public function depends(): HasMany
    {
        return $this->hasMany(MessageDepend::class);
    }
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
