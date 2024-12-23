<?php

namespace App\Domains\Application\Documents\Listeners;

use App\Domains\Application\Documents\Enums\LlamaCloud\LlamaDocumentStatusEnum;
use App\Domains\Application\Documents\Events\LLMDataProcessingEndedEvent;
use App\Domains\Application\Documents\Events\LLMDataProcessingRunningEvent;
use Exception;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreResultDocumentLlamaCloudListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LLMDataProcessingEndedEvent $event): void
    {
        try {
            $document = $event->document;

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer '.config('llama_cloud.api_key'),
            ])
                ->get(config('llama_cloud.api_url')."/parsing/job/$document->llama_cloud_id/result/json");

            if ($response->successful()) {
                $data = $response->json();

                $document->json_data = $data['pages'];
                $document->llama_cloud_job_metadata = $data['job_metadata'];
                $document->save();
            }
        } catch (Exception) {

        }
    }
}
