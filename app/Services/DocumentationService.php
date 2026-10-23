<?php



namespace App\Services;

use App\Enums\AppLocale;
use App\Enums\DocumentationType;
use App\Models\Documentation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class DocumentationService
{
    public function findForDownload(string $type, ?string $locale = null): ?Documentation
    {
        $documentationType = DocumentationType::tryFrom($type);
        if ($documentationType === null) {
            return null;
        }

        return Documentation::getByType(
            $documentationType->value,
            AppLocale::normalize($locale)->value,
        );
    }

    public function download(string $type, ?string $locale = null): BinaryFileResponse|Response
    {
        $documentationType = DocumentationType::tryFrom($type);
        if ($documentationType === null) {
            abort(404, 'Documentation not found');
        }

        $resolvedLocale = AppLocale::normalize($locale);
        $documentation = Documentation::getByType(
            $documentationType->value,
            $resolvedLocale->value,
        );

        if (!$documentation || !$documentation->file_path) {
            abort(404, 'Documentation not found');
        }

        $path = $this->resolveStoragePath($documentation, $documentationType);

        if ($path === null || str_contains($path, '..')) {
            Log::error('Documentation download rejected unsafe or empty path', [
                'type' => $documentationType->value,
                'locale' => $documentation->locale,
                'file_path' => $documentation->file_path,
            ]);
            abort(404, 'Documentation not found');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            Log::error('Documentation PDF missing from storage', [
                'type' => $documentationType->value,
                'locale' => $documentation->locale,
                'path' => $path,
            ]);
            abort(404, 'Documentation not found');
        }

        $absolutePath = $disk->path($path);
        $fileName = $this->buildDownloadFileName($documentation, $documentationType);

        return response()->download($absolutePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    private function resolveStoragePath(Documentation $documentation, DocumentationType $type): ?string
    {
        $path = $documentation->file_path;
        if (!$path) {
            return null;
        }

        // Support both "demos/file.pdf" and "file.pdf" (legacy)
        if (!str_contains($path, '/')) {
            $path = $type->storageDirectory() . '/' . $path;
        }

        return $path;
    }

    private function buildDownloadFileName(Documentation $documentation, DocumentationType $type): string
    {
        $locale = AppLocale::normalize($documentation->locale)->value;
        $custom = trim((string) $documentation->file_name);

        if ($custom !== '') {
            $base = pathinfo($custom, PATHINFO_FILENAME) ?: $custom;
            $base = preg_replace('/[^\w\s\-]/u', '_', $base) ?: $type->downloadBaseName();

            return trim($base) . '-' . $locale . '.pdf';
        }

        return $type->downloadBaseName() . '-' . $locale . '.pdf';
    }
}
