<?php

namespace App\Contracts;

interface Transformer
{
    
    public function transform($input): mixed;
}
