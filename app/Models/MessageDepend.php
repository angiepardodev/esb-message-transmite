<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageDepend extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $fillable = [
        'chain_tenant',
        'chain_ref',
    ];
}
