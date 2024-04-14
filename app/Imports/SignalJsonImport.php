<?php

namespace App\Imports;

use App\Contracts\SignalFormatImport;
use App\Core\Signal;

use function PHPUnit\Framework\matches;

class SignalJsonImport implements SignalFormatImport
{
    public function import(mixed $data): Signal
    {
        $parsed = match(gettype($data)) {
            'array' => $data,
            'string' => json_decode($data, true),
        };
        return new Signal($data, $parsed ?? [], 'json');
    }
}
