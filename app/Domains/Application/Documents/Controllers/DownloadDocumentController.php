<?php

namespace App\Domains\Application\Documents\Controllers;

use App\Domains\Application\Documents\Enums\DocumentTypeEnum;
use App\Domains\Application\Documents\Models\Document;
use App\Http\Controllers\Controller;
use Flux\Flux;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadDocumentController extends Controller
{
    public function __invoke(int $id, string $type = DocumentTypeEnum::JSON->value): JsonResponse|StreamedResponse
    {
        /** @var Document|null $document */
        $document = Document::find($id);

        if ($document === null) {
            Flux::toast(
                heading: 'Changes saved.',
                text: 'You can always update this in your settings.',
            );

            return response()->json();
        }

        $content = $filename = $headers = null;

        switch ($type) {
            case DocumentTypeEnum::PDF->value:
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
                $content = Storage::disk($document->disk)->get($document->stored_path.'/'.$document->stored_filename);
                $filename = $document->original_filename;
                break;
            case DocumentTypeEnum::JSON->value:
                $headers = [
                    'Content-Type' => 'application/json',
                ];
                $content = json_encode($document->json_data);
                $filename = pathinfo($document->original_filename, PATHINFO_FILENAME).'.json';
                break;
        }

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, $headers);
    }
}
