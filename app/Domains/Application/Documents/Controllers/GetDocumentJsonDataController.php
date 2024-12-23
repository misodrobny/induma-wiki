<?php

namespace App\Domains\Application\Documents\Controllers;

use App\Domains\Application\Documents\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GetDocumentJsonDataController extends Controller
{
    public function __invoke(?int $id = null): JsonResponse
    {
        if ($id === null) {
            return response()->json();
        }

        $document = Document::findOrFail($id);

        return response()->json(
            $document->json_data
        );
    }
}
