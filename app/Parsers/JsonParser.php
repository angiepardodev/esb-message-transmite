<?php

namespace App\Parsers;

use Illuminate\Http\Resources\MissingValue;

class JsonParser
{
    public function from(string $value): mixed
    {
        if ($value === 'undefined') {
            return new MissingValue();
        }
        
        $pattern = '/(?<=[:\s,\[])undefined(?=\s*[,}\]])/';
        $missing = new MissingValue;
        $serialize = serialize($missing);
        $undefined = json_encode($serialize);
        $replaced = preg_replace_callback($pattern, fn() => $undefined, $value);
        $parsed = json_decode($replaced, true);
        
        if (!is_array($parsed)) {
            return $parsed;
        }
        
        array_walk_recursive($parsed, fn(&$value) => $value = $value === $serialize ? $missing : $value);
        
        return $parsed;
    }
    
    public function to(mixed $value): string
    {
        if ($value instanceof MissingValue) {
            return 'undefined';
        }
        
        if (!is_array($value)) {
            return json_encode($value);
        }
        
        $missing = new MissingValue;
        $serialize = serialize($missing);
        $undefined = json_encode($serialize);
        array_walk_recursive($value, fn(&$value) => $value = $value instanceof $missing ? $serialize : $value);
        
        $unparsed = json_encode($value);
        
        return str_replace($undefined, 'undefined', $unparsed);
    }
}
