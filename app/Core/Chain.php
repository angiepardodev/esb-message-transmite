<?php

namespace App\Core;

class Chain
{
    
    /**
     * @param  Chain[]  $depends
     */
    public function __construct(
        public readonly string $ref,
        public readonly string $tenant,
        public readonly array $depends = []
    ) {
    }
}
