<?php

namespace App\Checkers;

use App\Contracts\Checker;

class ArrayChecker implements Checker
{
    
    public function check($input): bool
    {
        return is_array($input);
    }
}
