<?php

namespace App\Casts;

use App\Core\Signal;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class SignalCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Signal
    {
        $json = json_decode($value, true);
        return new Signal(
            $json['raw'], $json['parsed'], $json['source_type'], $json['metadata']
        );
    }
    
    /**
     * @param  Signal  $value
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return json_encode([
            'raw'         => $value->getRaw(),
            'parsed'      => $value->getParsed(),
            'source_type' => $value->getSourceType(),
            'metadata'    => $value->getMetadata(),
        ]);
    }
}
