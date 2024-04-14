<?php

namespace App\Transformers;

use App\Contracts\Transformer;

class CommaStringToArrayTransformer implements Transformer
{
    
    public function transform($input): array
    {
        return explode(',', $input);
    }
}
