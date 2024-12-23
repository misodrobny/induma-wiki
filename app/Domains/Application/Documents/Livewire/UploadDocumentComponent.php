<?php

namespace App\Domains\Application\Documents\Livewire;

use App\Domains\Application\Documents\Models\Document;
use Exception;
use Flux\Flux;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UploadDocumentComponent extends Component
{
    use WithFileUploads;

    #[Validate]
    public $name;

    #[Validate]
    /** @var TemporaryUploadedFile|null */
    public $file;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'file' => [
                'required',
                'mimetypes:application/pdf',
                'max:20480',
            ],
        ];
    }

    public function updated(): void
    {
        if ($this->file instanceof TemporaryUploadedFile) {
            $this->name = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
        }
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'Document name',
            'file' => 'File',
        ];
    }

    public function save(): void
    {
        $this->validate();

        try {
            $hash = sha1_file($this->file->getRealPath());
            $filename = $this->generateRandomFilename();
            $path = $this->generatePath($hash);
            $disk = config('filesystems.default');
            $this->file->storeAs(path: $path, name: $filename, options: ['disk' => $disk]);

            $document = new Document;
            $document->name = $this->name;
            $document->disk = $disk;
            $document->original_filename = $this->file->getClientOriginalName();
            $document->stored_filename = $filename;
            $document->stored_path = $path;
            $document->save();

            Flux::toast(
                text: __('application.pages.documents.upload.messages.success.stored'),
                variant: 'success'
            );

            $this->file = null;
            $this->name = null;
        } catch (Exception) {
            Flux::toast(
                text: __('application.pages.documents.upload.messages.error.stored'),
                variant: 'danger'
            );

        }
    }

    public function clearFile(): void
    {
        $this->file = null;
        $this->name = null;
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('domains.application.documents.livewire.upload-document-component');
    }

    private function generatePath(string $hash): string
    {
        return sprintf('%s/%s/%s/%s', config('filesystems.prefix'), substr($hash, 0, 2), substr($hash, 2, 2), substr($hash, 4, 2));
    }

    private function generateRandomFilename(): string
    {
        $timestamp = date('Ymd_His');
        $randomString = uniqid();

        return "file_{$timestamp}_$randomString";
    }
}
