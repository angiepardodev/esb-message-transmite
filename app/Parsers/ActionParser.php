<?php

namespace App\Parsers;

use App\Actions\CheckAction;
use App\Actions\TransformAction;
use App\Contracts\Checker;
use App\Contracts\Transformer;
use Illuminate\Support\Facades\App;

class ActionParser
{
    public function from($config): array
    {
        $actions = [];
        foreach ($config as $step) {
            $alias = $step['action'];
            $concrete = App::make($alias);
            
            if ($concrete instanceof Transformer) {
                $actions[] = new TransformAction($concrete);
            } elseif ($concrete instanceof Checker) {
                $onSuccess = $this->from($step['on_success']);
                $onFailure = $this->from($step['on_failure']);
                $actions[] = new CheckAction($concrete, $onSuccess, $onFailure);
            }
        }
        return $actions;
    }
}
