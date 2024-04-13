<?php

namespace App\Imports;

use App\Contracts\SignalFormatImport;
use App\Core\Signal;

class SignalJsonImport implements SignalFormatImport
{
    public function import(string $data): Signal
    {
        $parsed = json_decode($data, true);
        return new Signal($data, $parsed, 'json');
    }
}
