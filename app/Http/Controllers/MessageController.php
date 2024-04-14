<?php

namespace App\Http\Controllers;

use App\Core\Chain;
use App\Core\Composer;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Application;
use App\Models\Message;
use App\Models\Service;
use App\Services\ServiceMatcher;
use App\Services\SignalImport;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class MessageController extends Controller
{
    
    protected ServiceMatcher $setup;
    protected Composer $composer;
    
    public function __construct(Composer $composer, ServiceMatcher $setup)
    {
        $this->composer = $composer;
        $this->setup = $setup;
    }
    
    public function store(
        CreateMessageRequest $request,
        Application $origin,
        Application $destination,
        Service $service
    ) {
        $chain = $request->input('chain');
        
        if ($service->is_sync && $chain) {
            throw new ConflictHttpException(
                <<<MESSAGE
                The 'chain' field is required for asynchronous requests,
                but this service is configured as synchronous.
                MESSAGE
            );
        } elseif (!$service->is_sync && !$chain) {
            throw new ConflictHttpException(
                <<<MESSAGE
                The 'chain' field is only permitted for asynchronous requests,
                but this service is configured as synchronous.
                MESSAGE
            );
        }
        
        $source = SignalImport::driver($service->endpoint_parameters['content_type'])->import($request->input('raw'));
        $message = Message::make([
            'chain_ref' => $request->input('chain.ref'),
            'chain_tenant' => $origin->id,
            'service_id' => $service->id,
            'signal' => $source,
        ]);
        
        /** @var Chain $chain */
        $chain = $message->chain;
        
        foreach ($chain->depends ?? [] as $dependency) {
            $tenant = Application::find($dependency->tenant);
            if (!$tenant->is_chain_sharing_allowed) {
                throw new ConflictHttpException("$tenant->id don't allow use your chain");
            }
        }
        
        if ($service->is_sync) {
            $message->signal = $this->composer->processThrough(
                $message->signal,
                $message->service
            );
            $message->completed_at = Carbon::now();
        }
        
        $message->save();
        
        return MessageResource::make($message);
    }
}
