<?php

namespace App\Imports;

use App\Contracts\SignalFormatImport;
use App\Core\Signal;

class SignalXmlImport implements SignalFormatImport
{
    public function import(string $data): Signal
    {
        $xml = simplexml_load_string($data, options: LIBXML_NOCDATA);
        $parsed = json_decode(json_encode($xml), true);
        return new Signal($data, $parsed, 'xml');
    }
}
