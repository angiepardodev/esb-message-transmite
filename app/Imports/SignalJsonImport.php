<?php

namespace App\Imports;

use App\Core\Signal;

class SignalJsonImport
{
    public function import(string $data): Signal
    {
        $parsed = json_decode($data, true);
        return new Signal($data, $parsed, 'json');
    }
}
