<?php

namespace App\Domains\Application\Documents\Listeners;

use App\Domains\Application\Documents\Events\LLMDataProcessingRunningEvent;
use App\Domains\Application\Documents\Events\LLMDataProcessingTriggeredEvent;
use Exception;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class UploadDocumentToLlamaCloudListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct() {}

    public function handle(LLMDataProcessingTriggeredEvent $event): void
    {
        try {
            $document = $event->document;

            $content = Storage::disk($document->disk)->get($document->stored_path.'/'.$document->stored_filename);

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer '.config('llama_cloud.api_key'),
            ])
                ->attach('file', $content, $document->original_filename)
                ->post(config('llama_cloud.api_url').'/parsing/upload');

            if ($response->successful()) {
                $data = $response->json();

                $document->llama_cloud_id = $data['id'];
                $document->llama_cloud_status = $data['status'];
                $document->save();

                event(new LLMDataProcessingRunningEvent($document));
            }

        } catch (Exception $exception) {

        }
    }
}
