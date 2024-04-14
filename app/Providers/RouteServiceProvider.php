<?php

namespace App\Providers;

use App\Services\ServiceMatcher;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        
        $this->registerModelBindings();
    }
    
    protected function registerModelBindings(): void
    {
        Route::bind('service', function ($value, \Illuminate\Routing\Route $route) {
            $setup = app(ServiceMatcher::class);
            
            if (is_numeric($value)) {
                return $setup->findServiceById($value);
            }
            
            return $setup->findServiceFor(
                $route->parameter('origin'),
                $route->parameter('destination'),
                $value
            );
        });
    }
}
