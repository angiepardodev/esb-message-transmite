<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use NumberToWords\NumberToWords;

class NumberToWordsTransformer implements Transformer
{
    public function __construct(protected string $lang = 'es')
    {
    }
    
    public function transform($input): string
    {
        return NumberToWords::transformNumber($this->lang, $input);
    }
}
