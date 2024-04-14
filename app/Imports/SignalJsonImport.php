<?php

namespace App\Imports;

use App\Contracts\SignalFormatImport;
use App\Core\Signal;
use App\Parsers\JsonParser;

class SignalJsonImport implements SignalFormatImport
{
    public function __construct(protected JsonParser $parser)
    {
    }
    
    public function import(mixed $data): Signal
    {
        $parsed = match (gettype($data)) {
            'array' => $data,
            'string' => $this->parser->from($data),
        };
        return new Signal($data, $parsed ?? [], 'json');
    }
}
