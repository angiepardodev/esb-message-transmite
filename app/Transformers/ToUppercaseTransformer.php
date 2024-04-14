<?php

namespace App\Transformers;

use App\Contracts\Transformer;

class ToUppercaseTransformer implements Transformer
{
    
    public function transform($input): string
    {
        return strtoupper($input);
    }
}
