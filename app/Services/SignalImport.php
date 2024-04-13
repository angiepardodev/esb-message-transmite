<?php

namespace App\Services;

use App\Contracts\SignalFormatImport;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin SignalFormatImport
 */
class SignalImport extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SignalImportManager::class;
    }
}
