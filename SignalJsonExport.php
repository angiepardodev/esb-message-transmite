<?php

namespace App\Exports;

use App\Core\Signal;

class SignalJsonExport
{
    public function export(Signal $signal) :string
    {
        return json_encode($signal->getParsed());
    }
}
