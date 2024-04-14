<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use Illuminate\Http\Resources\MissingValue;
use NumberToWords\NumberToWords;

class DoUndefinedTransformer implements Transformer
{
    
    public function transform($input): MissingValue
    {
        return new MissingValue;
    }
}
