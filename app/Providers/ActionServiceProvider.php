<?php

namespace App\Providers;

use App\Checkers\ArrayChecker;
use App\Checkers\NumberChecker;
use App\Checkers\StringChecker;
use App\Transformers\ArrayToCommaStringTransformer;
use App\Transformers\CommaStringToArrayTransformer;
use App\Transformers\NumberToWordsTransformer;
use App\Transformers\DoUndefinedTransformer;
use App\Transformers\ToUppercaseTransformer;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Registers the instances for checking and transforming operations.
     * Note that definitions that do not have states can be set as singletons to optimize.
     */
    public function register(): void
    {
        $this->app->singleton('check:array', ArrayChecker::class);
        $this->app->singleton('check:number', NumberChecker::class);
        $this->app->singleton('check:string', StringChecker::class);
        
        $this->app->singleton('transform:array-to-comma-string', ArrayToCommaStringTransformer::class);
        $this->app->singleton('transform:comma-string-to-array', CommaStringToArrayTransformer::class);
        $this->app->bind('transform:number-to-words', NumberToWordsTransformer::class);
        $this->app->singleton('transform:undefined', DoUndefinedTransformer::class);
        $this->app->singleton('transform:uppercase', ToUppercaseTransformer::class);
    }
}
