<?php

namespace App\Domains\Application\Documents\Listeners;

use App\Domains\Application\Documents\Enums\LlamaCloud\LlamaDocumentStatusEnum;
use App\Domains\Application\Documents\Events\LLMDataProcessingEndedEvent;
use App\Domains\Application\Documents\Events\LLMDataProcessingRunningEvent;
use Exception;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckDocumentLlamaCloudStatusListener implements ShouldQueue
{
    use InteractsWithQueue;
    public function __construct() {}

    public function handle(LLMDataProcessingRunningEvent $event): void
    {
        try {
            $document = $event->document;

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer '.config('llama_cloud.api_key'),
            ])
                ->get(config('llama_cloud.api_url')."/parsing/job/$document->llama_cloud_id");

            if ($response->successful()) {
                $data = $response->json();

                $document->llama_cloud_status = $data['status'];
                $document->save();

                switch ($document->llama_cloud_status) {
                    case LlamaDocumentStatusEnum::PENDING:
                        event(new LLMDataProcessingRunningEvent($document));
                        break;
                    case LlamaDocumentStatusEnum::PARTIAL_SUCCESS:
                    case LlamaDocumentStatusEnum::SUCCESS:
                        event(new LLMDataProcessingEndedEvent($document));
                        break;
                    case LlamaDocumentStatusEnum::ERROR:
                        return;
                }
            }
        } catch (Exception) {

        }
    }
}
