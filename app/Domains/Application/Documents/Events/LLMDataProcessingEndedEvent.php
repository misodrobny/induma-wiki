<?php

namespace App\Domains\Application\Documents\Events;

use App\Domains\Application\Documents\Models\Document;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LLMDataProcessingEndedEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, InteractsWithQueue;

    public function __construct(public readonly Document $document) {}
}
