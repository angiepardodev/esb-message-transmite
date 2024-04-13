<?php

namespace App\Services;

use App\Imports\SignalJsonImport;
use App\Imports\SignalXmlImport;
use Illuminate\Support\Manager;

/**
 * @method SignalJsonImport driver($driver = null)
 */
class SignalImportManager extends Manager
{
    
    public function getDefaultDriver(): SignalJsonImport
    {
        return $this->createJsonDriver();
    }
    
    public function createJsonDriver(): SignalJsonImport
    {
        return new SignalJsonImport();
    }
    
    public function createXmlDriver(): SignalXmlImport
    {
        return new SignalXmlImport();
    }
}
