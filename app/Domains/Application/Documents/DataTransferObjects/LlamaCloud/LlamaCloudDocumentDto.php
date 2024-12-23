<?php

/** @noinspection PhpClassCanBeReadonlyInspection */

namespace App\Domains\Application\Documents\DataTransferObjects\LlamaCloud;

use App\Domains\Application\Documents\Models\Document;

class LlamaCloudDocumentDto
{
    public function __construct(
        public readonly Document $document,
    ) {}
}
