<?php

namespace App\Domains\Application\Documents\Listeners;

use App\Domains\Application\Documents\Events\LLMDataProcessingTriggeredEvent;
use App\Domains\Application\Documents\Models\Document;
use Exception;
use Http;
use Illuminate\Support\Facades\Storage;

class FetchDataForLLMListener
{
    public function __construct()
    {
    }

    public function handle(LLMDataProcessingTriggeredEvent $event): void
    {
        try {
            $document = $event->document;

            $content = Storage::disk($document->disk)->get($document->stored_path  . '/'. $document->stored_filename);

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('llama_cloud.api_key'),
            ])
                ->attach('file', $content, $document->original_filename)
                ->post(config('llama_cloud.api_url') . '/parsing/upload');

            if ($response->successful()) {
                $data = $response->json();
            }

            ray($data);
        }
        catch (Exception $exception) {

        }
    }
}
