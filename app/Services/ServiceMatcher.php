<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Service;

class ServiceMatcher
{
    public function findServiceById(int $id): Service
    {
        return Service::findOrFail($id);
    }
    
    public function findServiceFor(string|Application $origin, string|Application $destination, string $slug): Service
    {
        return Service::forIndex(to_key($origin), to_key($destination), $slug)->firstOrFail();
    }
}
