<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Message $resource */
class MessageResource extends JsonResource
{
    
    public static $wrap = false;
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'raw'        => $this->resource->signal->getRaw(),
            'parsed'     => $this->resource->signal->getParsed(),
            'callback'   => new static($this->resource->callback),
            'chain'      => $this->resource->chain,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
