<?php

namespace App\Checkers;

use App\Contracts\Checker;

class StringChecker implements Checker
{
    
    public function check($input): bool
    {
        return is_string($input);
    }
}
