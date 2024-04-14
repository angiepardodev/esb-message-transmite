<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'raw'                    => 'required|string',
            'chain'                  => 'array',
            'chain.ref'              => 'string',
            'chain.depends'          => 'array',
            'chain.depends.*.ref'    => 'string',
            'chain.depends.*.tenant' => 'string|exists:applications,id',
        ];
    }
}
