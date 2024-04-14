<?php

namespace App\Actions;

use App\Contracts\Action;
use App\Contracts\Transformer;

class TransformAction implements Action
{
    private Transformer $transformer;
    
    public function __construct(Transformer $transformer) {
        $this->transformer = $transformer;
    }
    
    public function execute($input) {
        return $this->transformer->transform($input);
    }
}
