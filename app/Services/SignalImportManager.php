<?php

namespace App\Services;

use App\Imports\SignalJsonImport;
use App\Imports\SignalXmlImport;
use App\Parsers\JsonParser;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Manager;

/**
 * @method SignalJsonImport driver($driver = null)
 */
class SignalImportManager extends Manager
{
    
    /**
     * @throws BindingResolutionException
     */
    public function createJsonDriver(): SignalJsonImport
    {
        return new SignalJsonImport(
            $this->container->make(JsonParser::class)
        );
    }
    
    public function createXmlDriver(): SignalXmlImport
    {
        return new SignalXmlImport();
    }
    
    /**
     * @throws BindingResolutionException
     */
    public function getDefaultDriver(): SignalJsonImport
    {
        return $this->createJsonDriver();
    }
}
