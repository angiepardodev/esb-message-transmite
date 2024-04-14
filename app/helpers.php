<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('to_key')) {
    function to_key(Model|string|int $input)
    {
        return $input instanceof Model ? $input->getKey() : $input;
    }
}
