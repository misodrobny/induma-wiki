<?php

namespace App\Domains\Application\Documents\Livewire;

use App\Domains\Application\Documents\Models\Document;
use App\Domains\Application\Documents\Traits\GenerateDocumentInfoTrait;
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
    use GenerateDocumentInfoTrait;

    #[Validate]
    public $name;

    #[Validate]
    /**
     * @var TemporaryUploadedFile|null
     * @noinspection PhpVarTagWithoutVariableNameInspection
     */
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
            'name' => __('application.pages.documents.upload.name'),
            'file' => __('application.forms.file'),
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
}
