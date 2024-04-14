<?php

namespace App\Casts;

use App\Parsers\JsonParser;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class JavascriptJsonCast implements CastsAttributes
{
    
    protected JsonParser $parser;
    
    public function __construct()
    {
        $this->parser = App::make(JsonParser::class);
    }
    
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $this->parser->from($value);
    }
    
    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return $this->parser->to($value);
    }
}
