<?php

namespace App\Checkers;

use App\Contracts\Checker;

class NumberChecker implements Checker
{
    
    public function check($input): bool
    {
        return is_numeric($input);
    }
}
