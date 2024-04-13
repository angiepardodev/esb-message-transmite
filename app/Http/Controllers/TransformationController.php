<?php

namespace App\Http\Controllers;

use App\Core\Composer;
use App\Models\Application;
use App\Services\ServiceMatcher;
use App\Services\SignalImport;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class TransformationController extends Controller
{
    protected Composer $composer;
    protected ServiceMatcher $setup;
    
    public function __construct(Composer $composer, ServiceMatcher $setup)
    {
        $this->composer = $composer;
        $this->setup = $setup;
    }
    
    public function run(Request $request, Application $origin, Application $destination, string $slug)
    {
        $source = SignalImport::driver($request->getContentTypeFormat())
            ->import($request->getContent());
        
        $signal = $this->composer->processThrough(
            $source,
            $this->setup->findServiceFor(
                $origin,
                $destination,
                $slug
            )
        );
        
        dd($signal);
    }
}
