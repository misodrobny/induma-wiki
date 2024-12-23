<?php

namespace App\Domains\Application\Documents\Models;

use App\Domains\Application\Documents\Enums\LlamaCloud\LlamaDocumentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Domains\Application\Documents\Models\Documents
 *
 * @property int $id
 * @property string|null $name
 * @property string $disk
 * @property string $stored_path
 * @property string $stored_filename
 * @property string $original_filename
 * @property array $json_data
 * @property string|null $llama_cloud_id
 * @property LlamaDocumentStatusEnum|null $llama_cloud_status
 * @property array|null $llama_cloud_job_metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static findOrFail($id)
 */
class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'disk',
        'stored_path',
        'stored_filename',
        'original_filename',
        'json_data',
        'llama_cloud_id',
        'llama_cloud_status',
        'llama_cloud_job_metadata',
    ];

    protected function casts(): array
    {
        return [
            'json_data' => 'json',
            'llama_cloud_job_metadata' => 'json',
            'llama_cloud_status' => LlamaDocumentStatusEnum::class,
        ];
    }
}
