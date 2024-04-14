<?php

namespace App\Transformers;

use App\Contracts\Transformer;

class ArrayToCommaStringTransformer implements Transformer
{
    
    public function transform($input): string
    {
        return implode(',', $input);
    }
}
