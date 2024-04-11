<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Service;

class SetupService
{
    public function findServiceFor(Application $origin, Application $destination, string $slug): Service
    {
        return Service::forIndex($origin->id, $destination->id, $slug)->firstOrFail();
    }
}
