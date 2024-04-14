<?php

namespace App\Core;

use App\Models\Message;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Carbon;

class Composer
{
    public function processThrough(Message $message): Message
    {
        $service = $message->service;
        $source = $message->signal;
        
        $transformations = $service->transformations()->get();
        
        $target = [];
        $dataSource = $source->getParsed();
        $missing = new MissingValue();
        foreach ($transformations as $transformation) {
            $value = data_get($dataSource, $transformation->origin_path, $missing);
            
            // $value = pipes($value)
            
            $mapping = $transformation->mapping;
            if ($mapping && $value === $mapping->source_data) {
                $value = $mapping->mapped_data;
            }
            
            data_set($target, $transformation->destination_path, $value);
        }
        
        $this->removeMissingValuesRecursively($target);
        
        $message->signal = $source->setParsed($target);
        $message->completed_at = Carbon::now();
        $message->save();
        
        return $message;
    }
    
    protected function removeMissingValuesRecursively(array &$array): void
    {
        foreach ($array as $key => &$value) {
            if ($value instanceof MissingValue) {
                unset($array[$key]);
            } elseif (is_array($value)) {
                $this->removeMissingValuesRecursively($value);
                // Reindex if the array is indexed
                if (array_values($value) === $value) {
                    $array[$key] = array_values($value);
                }
            }
        }
        // Reindexes the current level if necessary and is an indexed array
        if (array_values($array) === $array) {
            $array = array_values($array);
        }
    }
}
