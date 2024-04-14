<?php

namespace App\Casts;

use App\Core\Chain;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ChainCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Chain
    {
        if (empty($attributes['chain_ref'])) {
            return null;
        }
        
        $depends = array_map(
            fn($item) => new Chain($item['ref'], $item['tenant']),
            $model->chain_depends
        );
        
        return new Chain($attributes['chain_ref'], $attributes['chain_tenant'], $depends);
    }
    
    /**
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return [
            'chain_ref'    => $value->ref,
            'chain_tenant' => $value->tenant,
        ];
        //        if (empty($value)) {
        //            return;
        //        }
        return json_encode([
            'ref'     => $value->ref,
            'tenant'  => $value->tenant,
            'depends' => array_map(
                fn(Chain $item) => [
                    'ref'    => $item->ref,
                    'tenant' => $item->tenant,
                ],
                $value->depends
            ),
        ]);
    }
}
