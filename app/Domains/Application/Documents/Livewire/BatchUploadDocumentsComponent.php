<?php
/** @noinspection PhpComposerExtensionStubsInspection */

/** @noinspection PhpVarTagWithoutVariableNameInspection */


namespace App\Domains\Application\Documents\Livewire;

use App\Domains\Application\Documents\Models\Document;
use App\Domains\Application\Documents\Traits\GenerateDocumentInfoTrait;
use Exception;
use Flux\Flux;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Str;
use ZipArchive;

class BatchUploadDocumentsComponent extends Component
{
    use WithFileUploads;
    use GenerateDocumentInfoTrait;

    #[Validate]
    /**
     * @var TemporaryUploadedFile|null
     */
    public $file;

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimetypes:application/zip,application/octet-stream,application/x-zip-compressed,multipart/x-zip',
                'max:40480',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'file' => __('application.forms.file'),
        ];
    }

    public function save(): void
    {
        $this->validate();

        try {
            $zip = new ZipArchive();

            $tempFilePath = $this->file->storeAs('temp', Str::random(10).'.zip');

            if (!$tempFilePath) {
                Flux::toast(
                    text: __('application.pages.documents.batch_upload.messages.error_unable_upload_zip'),
                    variant: 'danger'
                );
            }

            $tempFileAbsolutePath = Storage::path($tempFilePath);

            if ($zip->open($tempFileAbsolutePath) === true) {

                $absoluteDestinationPath = Storage::disk(config('filesystems.default'))->path('temp_'.date('YmdHis'));

                if (!is_dir($absoluteDestinationPath)) {
                    mkdir($absoluteDestinationPath, 0755, true);
                }

                $zip->extractTo($absoluteDestinationPath);
                $zip->close();

                Storage::delete($tempFilePath);

                Flux::toast(
                    text: __('application.pages.documents.batch_upload.messages.success_zip_extract'),
                    variant: 'success'
                );

                sleep(2);

                foreach (glob($absoluteDestinationPath.'/*.pdf') as $pdFile) {
                    try {
                        $hash = sha1_file($pdFile);
                        $filename = $this->generateRandomFilename();
                        $path = $this->generatePath($hash);
                        $disk = config('filesystems.default');

                        Storage::disk($disk)->put($path.'/'.$filename, file_get_contents($pdFile));

                        $document = new Document;
                        $document->name = pathinfo($pdFile, PATHINFO_FILENAME);
                        $document->disk = $disk;
                        $document->original_filename = pathinfo($pdFile, PATHINFO_BASENAME);
                        $document->stored_filename = $filename;
                        $document->stored_path = $path;
                        $document->save();

                    } catch (Exception $e) {
                        Log::error($e->getMessage());
                    }
                }

                Flux::toast(
                    text: __('application.pages.documents.batch_upload.messages.success_document_created'),
                    variant: 'success'
                );

                if (Storage::exists($absoluteDestinationPath)) {
                    Storage::disk(config('filesystems.default'))->deleteDirectory($absoluteDestinationPath);
                }
            }

            Storage::disk(config('filesystems.default'))->delete($tempFilePath);

        } catch (Exception $e) {
            Log::error($e->getMessage());

            Flux::toast(
                text: $e->getMessage(),
                variant: 'danger'
            );
        }

        $this->clearFile();
    }

    public function clearFile(): void
    {
        $this->file = null;
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('domains.application.documents.livewire.batch-upload-documents-component');
    }
}
