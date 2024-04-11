<?php

namespace App;

use App\Models\Service;
use App\Models\Transformation;
use Illuminate\Http\Resources\MissingValue;

class Composer
{
    public function processThrough(array $source, Service $service)
    {
        $transformations = $service->transformations()->get();
        
        $target = [];
        $missing = new MissingValue();
        foreach ($transformations as $transformation) {
            $value = data_get($source, $transformation->origin_path, $missing);
            
            // $value = pipes($value)
            
            $mapping = $transformation->mapping;
            
            if ($mapping && $value === $mapping->source_data) {
                $value = $mapping->mapped_data;
            }
            
            data_set($target, $transformation->destination_path, $value);
        }
        
        return $target;
    }
}
