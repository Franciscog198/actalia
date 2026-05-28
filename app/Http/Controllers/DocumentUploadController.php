<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DocumentUploadController extends Controller
{
    public function create($token)
    {
        $contract = Contract::with('users')
            ->where('unique_token', $token)
            ->firstOrFail();

        return view('contracts.upload-documents', compact('contract'));
    }

    public function store(Request $request, $token)
    {
        $contract = Contract::where('unique_token', $token)
            ->firstOrFail();

        $request->validate([
            'documents' => 'required|array|min:1',
            'documents.*' => 'array',
            'documents.*.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        try {

            $uploadedCount = 0;

            $documents = $request->file('documents', []);

            if (empty($documents)) {

                \Log::error('NO HAY ARCHIVOS EN REQUEST');

                return back()->withErrors([
                    'error' => 'No se recibieron archivos'
                ]);
            }

            foreach ($documents as $documentType => $files) {

                if (!is_array($files)) {
                    continue;
                }

                foreach ($files as $index => $file) {

                    if (!$file || !$file->isValid()) {
                        continue;
                    }

                    $uploadedCount += $this->saveDocument(
                        $contract,
                        $file,
                        $documentType,
                        $index,
                        $request
                    );
                }
            }

            $contract->update([
                'current_step' => 3,
                'status' => 'pending_payment'
            ]);

            return redirect()
                ->route('payment.show', $contract->unique_token)
                ->with(
                    'success',
                    "¡{$uploadedCount} documento(s) subido(s)!"
                );

        } catch (\Exception $e) {

            \Log::error('UPLOAD ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            dd($e->getMessage());
        }
    }

    private function saveDocument(
        $contract,
        $file,
        $documentType,
        $index,
        $request
    ) {

        /**
         * =====================================
         * NOMBRE ARCHIVO
         * =====================================
         */
        $filename =
            time() .
            '_' .
            $documentType .
            '_' .
            $index .
            '_' .
            uniqid() .
            '.' .
            $file->getClientOriginalExtension();

        /**
         * =====================================
         * PATH BASE
         * =====================================
         */
        $path = "contracts/{$contract->id}/documents";

        /**
         * =====================================
         * DATOS ARCHIVO
         * =====================================
         */
        $originalFilename = $file->getClientOriginalName();

        $fileSize = $file->getSize();

        $mimeType = $file->getMimeType();

        /**
         * =====================================
         * DIMENSIONES
         * =====================================
         */
        $width = null;
        $height = null;

        try {

            $imageSize = getimagesize(
                $file->getRealPath()
            );

            $width = $imageSize[0] ?? null;

            $height = $imageSize[1] ?? null;

        } catch (\Exception $e) {

            \Log::warning($e->getMessage());
        }

        /**
         * =====================================
         * STORAGE LARAVEL
         * storage/app/public/contracts/...
         * =====================================
         */
        $storedPath = $path . '/' . $filename;

        /**
         * =====================================
         * REDIMENSIONAR IMAGEN
         * =====================================
         */
        $manager = new ImageManager(
        new Driver()
        );

        $image = $manager
            ->read($file->getRealPath())
            ->scale(width: 1400)
            ->toJpeg(80);
        /**
         * =====================================
         * GUARDAR ARCHIVO
         * =====================================
         */
        Storage::disk('public')->put(
            $storedPath,
            (string) $image
        );

        /**
         * =====================================
         * PUBLIC_HTML CUSTOM
         * public_html/app/storage/contracts/...
         * =====================================
         */
        $publicHtmlPath = base_path(
            '../public_html/app/storage/' . $path
        );

        if (!file_exists($publicHtmlPath)) {

            mkdir($publicHtmlPath, 0777, true);
        }

        /**
         * =====================================
         * COPIAR ARCHIVO
         * =====================================
         */
        copy(
            storage_path('app/public/' . $storedPath),
            $publicHtmlPath . '/' . $filename
        );

        /**
         * =====================================
         * LOG DEBUG
         * =====================================
         */
        \Log::info('DOCUMENTO GUARDADO', [

            'storage_path' =>
                storage_path('app/public/' . $storedPath),

            'exists_storage' =>
                file_exists(
                    storage_path('app/public/' . $storedPath)
                ),

            'public_html_path' =>
                $publicHtmlPath . '/' . $filename,

            'exists_public_html' =>
                file_exists(
                    $publicHtmlPath . '/' . $filename
                ),
        ]);

        /**
         * =====================================
         * URL PUBLICA
         * =====================================
         */
        $publicUrl = Storage::url($storedPath);

        /**
         * =====================================
         * THUMBNAIL
         * =====================================
         */
        $thumbnailPath = null;

        /**
         * =====================================
         * GUARDAR DB
         * =====================================
         */
        $doc = ContractDocument::create([

            'contract_id' => $contract->id,

            'user_id' => null,

            'document_type' => $this->mapDocumentType(
                $documentType
            ),

            'original_filename' => $originalFilename,

            'storage_path' => $storedPath,

            'public_url' => $publicUrl,

            'thumbnail_path' => $thumbnailPath,

            'file_size' => $fileSize,

            'mime_type' => $mimeType,

            'width' => $width,

            'height' => $height,

            'page_number' =>
                $documentType === 'contrato_firmado'
                    ? $index + 1
                    : null,

            'order' => $index,

            'uploaded_from' => 'mobile',

            'ip_address' => $request->ip(),

            'uploaded_at' => now(),
        ]);

        if (!$doc) {

            dd('ERROR GUARDANDO DOCUMENTO EN BD');
        }

        return 1;
    }

    private function mapDocumentType($type)
    {
        return match ($type) {

            'dni_locador',
            'dni_locatario',
            'dni_garante'
                => 'dni_front',

            'foto_locador',
            'foto_locatario',
            'foto_garante'
                => 'selfie',

            'contrato_firmado'
                => 'contract_page',

            default
                => 'other',
        };
    }
}