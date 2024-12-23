<?php

namespace App\Domains\Application\Documents\Enums\LlamaCloud;

enum LlamaDocumentStatusEnum: string
{
    case PENDING = 'PENDING';
    case SUCCESS = 'SUCCESS';
    case PARTIAL_SUCCESS = 'PARTIAL_SUCCESS';
    case ERROR = 'ERROR';
}
