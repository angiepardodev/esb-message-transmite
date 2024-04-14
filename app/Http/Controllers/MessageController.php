<?php

namespace App\Http\Controllers;

use App\Core\Chain;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Application;
use App\Models\Message;
use App\Services\ServiceMatcher;
use App\Services\SignalImport;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class MessageController extends Controller
{
    
    protected ServiceMatcher $setup;
    
    public function __construct(ServiceMatcher $setup)
    {
        $this->setup = $setup;
    }
    
    public function store(CreateMessageRequest $request, Application $origin, Application $destination, string $slug)
    {
        $service = $this->setup->findServiceFor(
            $origin,
            $destination,
            $slug
        );
        
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
        
        $message->save();
        
        return MessageResource::make($message);
    }
}
