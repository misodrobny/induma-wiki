<?php

namespace App\Domains\Application\Documents\Traits;

trait GenerateDocumentInfoTrait
{
    public function generatePath(string $hash): string
    {
        return sprintf('%s/%s/%s/%s', config('filesystems.prefix'), substr($hash, 0, 2), substr($hash, 2, 2), substr($hash, 4, 2));
    }

    public function generateRandomFilename(): string
    {
        $timestamp = date('Ymd_His');
        $randomString = uniqid();

        return "file_{$timestamp}_$randomString";
    }
}