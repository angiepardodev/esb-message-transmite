<?php

namespace App\Actions;

use App\Contracts\Action;
use App\Contracts\Checker;

class CheckAction implements Action
{
    
    private Checker $checker;
    private ?array $onSuccess = null;
    private ?array $onFailure = null;
    
    public function __construct(Checker $checker, $onSuccess, $onFailure) {
        $this->checker = $checker;
        $this->onSuccess = $onSuccess;
        $this->onFailure = $onFailure;
    }
    
    public function execute($input) {
        if ($this->checker->check($input)) {
            foreach ($this->onSuccess ?? [] as $action) {
                $input = $action->execute($input);
            }
        } else {
            foreach ($this->onFailure ?? [] as $action) {
                $input = $action->execute($input);
            }
        }
        return $input;
    }
}
