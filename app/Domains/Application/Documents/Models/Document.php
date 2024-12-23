<?php

namespace App\Domains\Application\Documents\Models;

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
    ];

    protected function casts(): array
    {
        return [
            'json_data' => 'array',
        ];
    }
}
